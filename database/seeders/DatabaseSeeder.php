<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Administrator User
        $admin = User::firstOrCreate(
            ['email' => 'admin@conduit.test'],
            [
                'name' => 'The Conduit Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. Create Staff Author User
        $staff = User::firstOrCreate(
            ['email' => 'editor@conduit.test'],
            [
                'name' => 'Elena Rostova',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );

        // 3. Create 6 Sample Articles
        $articles = [
            [
                'title' => 'Diagnostic Frontiers: Artificial Intelligence in Modern Clinical Practice',
                'slug' => 'diagnostic-frontiers-artificial-intelligence-in-modern-clinical-practice',
                'excerpt' => 'A comprehensive exploration of how deep learning architectures and computerized imaging are revolutionizing bedside diagnostic speeds in tertiary hospitals.',
                'content' => '<p>Modern medical practitioners stand at an extraordinary nexus of computing power and bedside intuition. Neural networks trained on millions of radiological scans are now capable of pinpointing micro-calcifications and subtle tissue densities hours before traditional laboratory confirmation becomes feasible.</p><p>Yet, this digital acceleration brings critical ethical and logistical considerations. Clinical directors across regional healthcare networks caution that algorithmic recommendations must always remain subordinate to seasoned human diagnostic judgment, ensuring empathetic care remains centered around patient dignity.</p><p>As The Conduit continues to document this paradigm shift, our multimedia reporters are gathering first-hand observations from trauma centers and diagnostic suites to deliver clear, unbiased reporting on computational healthcare.</p>',
                'featured_image' => 'https://picsum.photos/800/500?random=1',
                'category' => 'News',
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'user_id' => $admin->id,
            ],
            [
                'title' => 'The Shutter and the Scalpel: Documenting Humanitarian Frontlines',
                'slug' => 'the-shutter-and-the-scalpel-documenting-humanitarian-frontlines',
                'excerpt' => 'Visual journalism within remote triage units reveals the profound resilience of surgical volunteers working in regions facing acute infrastructure deficits.',
                'content' => '<p>The camera shutter serves as both a silent witness and a conduit of truth. In austere field hospitals operating beyond the reach of municipal electrical grids, documentary photographers capture the quiet determination of emergency volunteer medical squads.</p><p>Each visual composition demands strict adherence to journalistic ethics. Preserving patient autonomy while communicating the urgency of medical supply chain blockades requires a nuanced balance between raw visual realism and deep human compassion.</p><p>This visual dispatch features exclusive field photographs and audio recordings from our recent overland deployment, highlighting the indispensable contributions of community nursing networks.</p>',
                'featured_image' => 'https://picsum.photos/800/500?random=2',
                'category' => 'Multimedia',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'user_id' => $staff->id,
            ],
            [
                'title' => 'Equitable Therapeutics: Overcoming Global Pharmaceutical Supply Bottlenecks',
                'slug' => 'equitable-therapeutics-overcoming-global-pharmaceutical-supply-bottlenecks',
                'excerpt' => 'An investigative report into cold-chain shipping logistics, patent flexibilities, and regional generic manufacturing initiatives across developing economies.',
                'content' => '<p>The international pharmaceutical supply chain is a delicate web susceptible to trade disruptions, tariff volatility, and cold-chain breakdowns. For millions living in isolated rural corridors, access to temperature-sensitive biologics remains precarious.</p><p>Recent multilateral agreements on patent pooling and open-source drug compounding are opening new avenues for domestic manufacture. Regional laboratories in sub-Saharan Africa and Southeast Asia are increasingly synthesizing essential anti-infective formulations independently.</p><p>Public health advocates emphasize that real healthcare equity requires permanent decentralized infrastructure rather than temporary donor charity campaigns.</p>',
                'featured_image' => 'https://picsum.photos/800/500?random=3',
                'category' => 'Feature',
                'status' => 'published',
                'published_at' => now()->subDays(9),
                'user_id' => $admin->id,
            ],
            [
                'title' => 'The Editorial Responsibility: Defending Scientific Rigor in Digital Media',
                'slug' => 'the-editorial-responsibility-defending-scientific-rigor-in-digital-media',
                'excerpt' => 'Editorial commentary on combatting sensationalist biomedical headlines and reinforcing public trust through transparent peer-reviewed reporting.',
                'content' => '<p>Sensationalism is an acute contagion in digital journalism. When preliminary pre-print studies are packaged as definitive miracle breakthroughs by click-driven outlets, public trust in medical science experiences irreparable erosion.</p><p>Independent publications like The Conduit must maintain rigorous verification pipelines. Peer evaluation, disclosure of financial sponsorships, and explicit articulation of experimental bounds are non-negotiable principles of responsible journalism.</p><p>Our editorial stance remains steadfast: clarity over sensationalism, nuance over hyperbole, and an unwavering commitment to truth.</p>',
                'featured_image' => 'https://picsum.photos/800/500?random=4',
                'category' => 'Opinion',
                'status' => 'published',
                'published_at' => now()->subDays(14),
                'user_id' => $staff->id,
            ],
            [
                'title' => 'Resonance and Recovery: Acoustic Environments in Critical Care Wards',
                'slug' => 'resonance-and-recovery-acoustic-environments-in-critical-care-wards',
                'excerpt' => 'Investigating neurological research on how targeted soundscapes and low-frequency auditory resonance improve clinical recovery in intensive care units.',
                'content' => '<p>Hospital intensive care units are notoriously clamorous spaces filled with irregular monitor alarms, pressurized pumps, and institutional noise. Neuro-acoustic researchers have shown that chronic sonic stress hinders deep restorative sleep and elevates patient cortisol levels.</p><p>By installing customized acoustic baffling and broadcasting low-amplitude harmonic resonance frequencies, pioneering surgical recovery wards are observing measurable reductions in hypertensive fluctuations and delirium episodes.</p><p>Our production team is compiling a multi-track spatial audio companion to illustrate how deliberate sound design fosters clinical healing.</p>',
                'featured_image' => 'https://picsum.photos/800/500?random=5',
                'category' => 'Multimedia',
                'status' => 'draft',
                'published_at' => null,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Next-Generation Field Diagnostics: Lab-on-a-Chip Innovation',
                'slug' => 'next-generation-field-diagnostics-lab-on-a-chip-innovation',
                'excerpt' => 'An upcoming investigation into microfluidic testing cassettes capable of detecting viral pathogens within fifteen minutes using ambient sunlight.',
                'content' => '<p>Microfluidics technology is shrinking multi-room laboratory test equipment into handheld glass and polymer cassettes the size of a standard postage stamp.</p><p>These portable diagnostic tools require no refrigeration, no external power cables, and only a single drop of capillary blood. Preliminary field trials demonstrate accuracy comparable to high-complexity metropolitan testing machines.</p><p>Full technical dossiers and field interview video footage will accompany the finalized publication of this report once international trial benchmarks conclude.</p>',
                'featured_image' => 'https://picsum.photos/800/500?random=6',
                'category' => 'News',
                'status' => 'draft',
                'published_at' => null,
                'user_id' => $staff->id,
            ],
        ];

        foreach ($articles as $articleData) {
            Article::updateOrCreate(
                ['slug' => $articleData['slug']],
                $articleData
            );
        }
    }
}
