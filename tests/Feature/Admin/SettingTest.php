<?php

namespace Tests\Feature\Admin;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->regularUser = User::factory()->create([
            'is_admin' => false,
        ]);
    }

    public function test_non_admin_cannot_access_settings(): void
    {
        $response = $this->actingAs($this->regularUser)->get('/admin/settings');
        $response->assertStatus(403);
    }

    public function test_guest_is_redirected_to_login_when_accessing_settings(): void
    {
        $response = $this->get('/admin/settings');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_view_settings_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/settings');
        $response->assertStatus(200);
        $response->assertSee('Front Page Hero Photography');
    }

    public function test_admin_can_update_text_settings(): void
    {
        $response = $this->actingAs($this->admin)->put('/admin/settings', [
            'site_title' => 'The Conduit Gazette',
            'hero_headline' => 'Groundbreaking Medical Investigations',
            'contact_email' => 'investigate@conduit.org',
        ]);

        $response->assertRedirect(route('admin.settings.index'));
        $response->assertSessionHas('success');

        $this->assertEquals('The Conduit Gazette', Setting::get('site_title'));
        $this->assertEquals('Groundbreaking Medical Investigations', Setting::get('hero_headline'));
        $this->assertEquals('investigate@conduit.org', Setting::get('contact_email'));
    }

    public function test_admin_can_upload_hero_background_image(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('custom-hero.jpg', 1920, 1080);

        $response = $this->actingAs($this->admin)->put('/admin/settings', [
            'hero_bg_image' => $file,
        ]);

        $response->assertRedirect(route('admin.settings.index'));

        $setting = Setting::where('key', 'hero_bg_image')->first();
        $this->assertNotNull($setting);
        $this->assertNotNull($setting->value);

        Storage::disk('public')->assertExists($setting->value);
    }

    public function test_admin_can_upload_site_logo_and_resolve_url(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('custom-logo.png', 500, 500);

        $response = $this->actingAs($this->admin)->put('/admin/settings', [
            'site_logo' => $file,
        ]);

        $response->assertRedirect(route('admin.settings.index'));

        $setting = Setting::where('key', 'site_logo')->first();
        $this->assertNotNull($setting);
        $this->assertNotNull($setting->value);

        Storage::disk('public')->assertExists($setting->value);

        $resolvedUrl = Setting::get('site_logo');
        $this->assertStringContainsString('storage/' . $setting->value, $resolvedUrl);
    }
}
