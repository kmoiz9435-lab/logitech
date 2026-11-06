<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\WhyChooseItem;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Induction Heating Machines',
                'slug' => 'induction-heating-machines',
                'description' => 'Versatile high-frequency induction heating systems for precise, localized heating across production and workshop applications.',
                'image' => 'seed/product-15kw.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Induction Melting Furnaces',
                'slug' => 'induction-melting-furnaces',
                'description' => 'Compact and medium-frequency induction melting solutions for ferrous and non-ferrous metals.',
                'image' => 'seed/product-25kw.jpg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Induction Forging Systems',
                'slug' => 'induction-forging-systems',
                'description' => 'High-throughput billet and bar heating systems engineered for modern forging operations.',
                'image' => 'seed/product-50kw.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Heat Treatment Systems',
                'slug' => 'heat-treatment-systems',
                'description' => 'Controlled induction hardening, annealing and tempering systems for repeatable metallurgical results.',
                'image' => 'seed/product-heat-treatment.jpg',
                'sort_order' => 4,
            ],
            [
                'name' => 'Brazing & Soldering Systems',
                'slug' => 'brazing-soldering-systems',
                'description' => 'Precision induction brazing systems for clean, fast and repeatable metallurgical joints.',
                'image' => 'seed/product-brazing.jpg',
                'sort_order' => 5,
            ],
        ];

        $categoryMap = [];

        foreach ($categories as $category) {
            $categoryMap[$category['slug']] = ProductCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category + ['is_active' => true]
            );
        }

        $products = [
            [
                'slug' => 'ih-15-high-frequency-induction-heating-machine',
                'name' => 'IH-15 High-Frequency Induction Heating Machine',
                'category' => 'induction-heating-machines',
                'image' => 'seed/product-15kw.jpg',
                'short_description' => 'A compact 15 kW high-frequency induction heater for fast, precise and repeatable localized heating of small to medium metal components.',
                'description' => "The IH-15 is a compact, high-frequency induction heating machine built for workshops and production cells that need fast, controlled heat exactly where it is required. Its digital power control and tightly engineered coil compatibility deliver consistent results across repeated cycles.\n\nWith a 15 kW output and a 30–100 kHz frequency range, the IH-15 is ideal for brazing, shrink fitting, annealing, bolt heating and laboratory work. The air-to-water cooling design, comprehensive protection circuits and rugged cabinet construction make it a dependable everyday production tool.\n\nThe system is supplied ready for integration with application-specific induction coils. Our engineering team can specify the coil geometry and process recipe for your part, material and target temperature.",
                'featured' => true,
                'specs' => [
                    ['Rated Power', '15 kW'],
                    ['Frequency Range', '30 – 100 kHz'],
                    ['Input Voltage', '3-phase, 380 V ±10%'],
                    ['Duty Cycle', '100%'],
                    ['Cooling System', 'Water cooled'],
                    ['Max. Work Temperature', '1,100 °C'],
                    ['Control System', 'IGBT digital control'],
                    ['Efficiency', '≥ 95%'],
                ],
                'features' => [
                    'Fast, localized heating with minimal distortion',
                    'IGBT power conversion for stable, repeatable output',
                    'Digital interface with precise power adjustment',
                    'Compact footprint for bench or production-cell installation',
                    'Comprehensive over-current, over-voltage and water-flow protection',
                    'Low energy consumption and high power efficiency',
                ],
                'applications' => [
                    'Brazing and soldering',
                    'Shrink fitting and bearing assembly',
                    'Annealing and stress relief',
                    'Bolt and fastener heating',
                    'Laboratory and R&D heating',
                ],
                'images' => ['seed/gallery-5.jpg', 'seed/gallery-7.jpg'],
                'seo_title' => 'IH-15 High-Frequency Induction Heating Machine | InduHeat',
                'seo_description' => 'Compact 15 kW high-frequency induction heating machine for brazing, shrink fitting and annealing. Precise digital control, water cooling and 100% duty cycle.',
            ],
            [
                'slug' => 'ih-25-induction-melting-furnace',
                'name' => 'IH-25 Induction Melting Furnace',
                'category' => 'induction-melting-furnaces',
                'image' => 'seed/product-25kw.jpg',
                'short_description' => 'A 25 kW induction melting furnace for precious and non-ferrous metals, with rapid melt times and accurate temperature control.',
                'description' => "The IH-25 induction melting furnace brings efficient, clean melting to compact foundries, jewellery manufacturers, laboratories and metal workshops. The 25 kW power supply rapidly couples energy into the charge, reducing melt times and minimizing oxidation.\n\nThe system uses a rugged induction coil and high-purity ceramic crucible assembly, with water-cooled components for stable continuous operation. Temperature can be monitored and controlled throughout the melt, making the IH-25 suitable for repeatable alloy preparation.\n\nAvailable with a range of crucible capacities and optional tilt mechanisms, the furnace can be configured around your material, batch size and shop-floor layout.",
                'featured' => true,
                'specs' => [
                    ['Rated Power', '25 kW'],
                    ['Frequency Range', '15 – 30 kHz'],
                    ['Crucible Capacity', '10 kg (steel equivalent)'],
                    ['Max. Melt Temperature', '1,600 °C'],
                    ['Input Voltage', '3-phase, 380 V ±10%'],
                    ['Cooling System', 'Water cooled'],
                    ['Duty Cycle', '80%'],
                    ['Protection', 'Over-current / over-temperature / water flow'],
                ],
                'features' => [
                    'Rapid, efficient melting of ferrous and non-ferrous metals',
                    'Uniform electromagnetic stirring for consistent alloy composition',
                    'High-purity ceramic crucible assembly',
                    'Digital power and temperature control',
                    'Water-cooled coil and power components',
                    'Compact, mobile frame with optional tilt pour',
                ],
                'applications' => [
                    'Precious metal melting',
                    'Aluminium and copper alloys',
                    'Sample preparation and laboratories',
                    'Small-batch foundry production',
                    'Alloy development',
                ],
                'images' => ['seed/gallery-1.jpg', 'seed/gallery-3.jpg'],
                'seo_title' => 'IH-25 Induction Melting Furnace | 25 kW Metal Melting',
                'seo_description' => '25 kW induction melting furnace for precious and non-ferrous metals. Rapid melting, uniform alloy mixing and accurate temperature control.',
            ],
            [
                'slug' => 'ih-50-induction-forging-heater',
                'name' => 'IH-50 Induction Forging Heater',
                'category' => 'induction-forging-systems',
                'image' => 'seed/product-50kw.jpg',
                'short_description' => 'A 50 kW induction billet heating system engineered for fast, uniform heating in forging and hot-forming production lines.',
                'description' => "The IH-50 is a production-grade induction forging heater designed for continuous billet and bar heating. Its medium-frequency output delivers deep, uniform heat through the workpiece, preparing material for forging with minimal scale and consistent temperature from surface to core.\n\nThe system can be supplied with a custom feed and discharge arrangement, infrared temperature feedback and PLC integration for automated forging cells. Modular coil sections allow the heating profile to be tuned to your billet size, material and cycle time.\n\nBuilt for demanding environments, the IH-50 combines a robust power cabinet, industrial cooling circuit and comprehensive diagnostics to keep your line running.",
                'featured' => true,
                'specs' => [
                    ['Rated Power', '50 kW'],
                    ['Frequency Range', '1 – 10 kHz'],
                    ['Heating Capacity', 'Up to 350 kg/hour'],
                    ['Billet Diameter', '20 – 80 mm'],
                    ['Max. Heating Temperature', '1,250 °C'],
                    ['Input Voltage', '3-phase, 380 V ±10%'],
                    ['Cooling System', 'Closed-loop water cooling'],
                    ['Control', 'PLC + infrared temperature feedback'],
                ],
                'features' => [
                    'Uniform through-heating for consistent forging quality',
                    'High throughput with rapid startup and shutdown',
                    'PLC integration for automated production lines',
                    'Modular induction coils for different billet sizes',
                    'Low scale formation compared with fuel-fired heating',
                    'Heavy-duty cabinet and industrial cooling system',
                ],
                'applications' => [
                    'Billet heating for forging',
                    'Hot upsetting and heading',
                    'Bar end heating',
                    'Roll forming and extrusion support',
                    'Fastener manufacturing',
                ],
                'images' => ['seed/gallery-2.jpg', 'seed/gallery-6.jpg'],
                'seo_title' => 'IH-50 Induction Forging Heater | Billet Heating System',
                'seo_description' => '50 kW induction forging heater for fast, uniform billet heating. PLC integration, infrared temperature control and high-throughput performance.',
            ],
            [
                'slug' => 'ih-80-induction-hardening-system',
                'name' => 'IH-80 Induction Hardening System',
                'category' => 'heat-treatment-systems',
                'image' => 'seed/product-80kw.jpg',
                'short_description' => 'An 80 kW induction hardening system for controlled surface hardening of shafts, gears and wear-critical components.',
                'description' => "The IH-80 induction hardening system delivers controlled, repeatable surface hardening for components that must resist wear while retaining a tough core. The high-power output and application-specific coil design produce a precisely defined hardened zone with minimal distortion.\n\nThe system supports integrated quenching, programmable heating profiles and temperature feedback for consistent metallurgical results. It is well suited to shafts, gear teeth, splines, pins and other wear-critical parts.\n\nOur engineers work with you to develop the hardening recipe, coil geometry and fixture design, then support validation with hardness-depth and microstructure checks.",
                'featured' => true,
                'specs' => [
                    ['Rated Power', '80 kW'],
                    ['Frequency Range', '10 – 50 kHz'],
                    ['Hardening Depth', '0.5 – 6 mm (application dependent)'],
                    ['Max. Surface Temperature', '1,050 °C'],
                    ['Input Voltage', '3-phase, 380 V ±10%'],
                    ['Cooling System', 'Water cooled + quench circuit'],
                    ['Control System', 'PLC with recipe storage'],
                    ['Duty Cycle', '100%'],
                ],
                'features' => [
                    'Precise, repeatable surface-hardening profiles',
                    'Minimal distortion compared with furnace hardening',
                    'Integrated quench control and monitoring',
                    'Programmable recipes for multiple part numbers',
                    'Fast cycle times for high-volume production',
                    'Application-specific coil and fixture design',
                ],
                'applications' => [
                    'Shaft and axle hardening',
                    'Gear and spline hardening',
                    'Pin and fastener hardening',
                    'Wear-part surface treatment',
                    'Selective hardening of assemblies',
                ],
                'images' => ['seed/gallery-3.jpg', 'seed/product-heat-treatment.jpg'],
                'seo_title' => 'IH-80 Induction Hardening System | Precision Heat Treatment',
                'seo_description' => '80 kW induction hardening system for shafts, gears and wear-critical components. Programmable recipes, integrated quench and repeatable results.',
            ],
            [
                'slug' => 'ih-30-precision-brazing-system',
                'name' => 'IH-30 Precision Brazing System',
                'category' => 'brazing-soldering-systems',
                'image' => 'seed/product-brazing.jpg',
                'short_description' => 'A 30 kW induction brazing system for clean, fast and repeatable joints in tubular, carbide and multi-part assemblies.',
                'description' => "The IH-30 precision brazing system applies heat only where the joint needs it, producing clean, repeatable brazed connections with minimal thermal impact on surrounding material. It is ideal for tube assemblies, carbide tooling, heat exchangers and electrical components.\n\nAccurate power control and application-specific coils allow consistent filler flow and joint quality, while short heating cycles reduce oxidation and the need for post-process cleaning. The system can be configured for manual benchtop operation or integrated into automated production equipment.\n\nWe support process development from sample trials through to production, including coil design, fixture recommendations and cycle-time optimisation.",
                'featured' => false,
                'specs' => [
                    ['Rated Power', '30 kW'],
                    ['Frequency Range', '30 – 80 kHz'],
                    ['Max. Joint Temperature', '1,200 °C'],
                    ['Input Voltage', '3-phase, 380 V ±10%'],
                    ['Cooling System', 'Water cooled'],
                    ['Duty Cycle', '100%'],
                    ['Control', 'Digital power and timer control'],
                    ['Atmosphere', 'Air / inert gas option'],
                ],
                'features' => [
                    'Localized heating protects surrounding components',
                    'Fast cycles with clean, repeatable joints',
                    'Digital timer and power control for process consistency',
                    'Interchangeable coils for different joint geometries',
                    'Optional inert-gas shielding for sensitive assemblies',
                    'Bench or automated line configuration',
                ],
                'applications' => [
                    'Carbide tool brazing',
                    'Tube and pipe assemblies',
                    'Heat exchanger joints',
                    'Electrical contact brazing',
                    'HVAC and refrigeration components',
                ],
                'images' => ['seed/gallery-5.jpg', 'seed/gallery-1.jpg'],
                'seo_title' => 'IH-30 Precision Induction Brazing System | InduHeat',
                'seo_description' => '30 kW induction brazing system for carbide tools, tube assemblies and heat exchangers. Localized heating, fast cycles and repeatable joints.',
            ],
            [
                'slug' => 'ht-100-induction-heat-treatment-system',
                'name' => 'HT-100 Induction Heat Treatment System',
                'category' => 'heat-treatment-systems',
                'image' => 'seed/product-heat-treatment.jpg',
                'short_description' => 'A 100 kW induction heat treatment platform for annealing, normalizing, tempering and stress-relief applications.',
                'description' => "The HT-100 is a high-capacity induction heat treatment system for demanding thermal processes. It provides controlled heating for annealing, normalizing, tempering and stress relief, with programmable profiles and data logging for process traceability.\n\nThe system is engineered around the workpiece and production flow, with custom coil and handling options for bars, tubes, plates and formed components. Closed-loop temperature control helps maintain consistent metallurgical outcomes across shifts and operators.\n\nWith industrial-grade power electronics and a serviceable modular layout, the HT-100 is built for continuous production environments where uptime matters.",
                'featured' => true,
                'specs' => [
                    ['Rated Power', '100 kW'],
                    ['Frequency Range', '1 – 20 kHz'],
                    ['Max. Temperature', '1,200 °C'],
                    ['Input Voltage', '3-phase, 380 V ±10%'],
                    ['Cooling System', 'Closed-loop water cooling'],
                    ['Control System', 'PLC + HMI with recipe storage'],
                    ['Duty Cycle', '100%'],
                    ['Data Logging', 'Temperature and cycle history'],
                ],
                'features' => [
                    'High-capacity heating for large components and volumes',
                    'Programmable thermal profiles with recipe storage',
                    'Closed-loop temperature control and data logging',
                    'Custom coil and handling system options',
                    'Modular, service-friendly power cabinet',
                    'Consistent results across production shifts',
                ],
                'applications' => [
                    'Annealing and normalizing',
                    'Tempering and stress relief',
                    'Post-weld heat treatment',
                    'Tube and bar heat treatment',
                    'Large-component processing',
                ],
                'images' => ['seed/gallery-6.jpg', 'seed/product-80kw.jpg'],
                'seo_title' => 'HT-100 Induction Heat Treatment System | InduHeat',
                'seo_description' => '100 kW induction heat treatment system for annealing, normalizing and stress relief. Programmable profiles, closed-loop control and production reliability.',
            ],
        ];

        foreach ($products as $data) {
            $product = Product::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'product_category_id' => $categoryMap[$data['category']]->id,
                    'name' => $data['name'],
                    'short_description' => $data['short_description'],
                    'description' => $data['description'],
                    'main_image' => $data['image'],
                    'is_featured' => $data['featured'],
                    'is_active' => true,
                    'seo_meta_title' => $data['seo_title'],
                    'seo_meta_description' => $data['seo_description'],
                    'sort_order' => 0,
                ]
            );

            foreach ($data['specs'] as $index => $spec) {
                $product->specifications()->updateOrCreate(
                    ['label' => $spec[0]],
                    ['value' => $spec[1], 'sort_order' => $index]
                );
            }

            foreach ($data['features'] as $index => $feature) {
                $product->features()->updateOrCreate(
                    ['title' => $feature],
                    ['sort_order' => $index]
                );
            }

            foreach ($data['applications'] as $index => $application) {
                $product->applications()->updateOrCreate(
                    ['title' => $application],
                    ['sort_order' => $index]
                );
            }

            foreach ($data['images'] as $index => $image) {
                $product->images()->updateOrCreate(
                    ['image' => $image],
                    ['alt_text' => $data['name'], 'sort_order' => $index]
                );
            }
        }

        $industries = [
            ['Automotive Industry', 'Induction heating for powertrain components, fasteners, bearings and assembly operations.', 'car', 1],
            ['Metal Processing', 'Precise heating for forming, joining, coating and thermal processing of ferrous and non-ferrous metals.', 'layers', 2],
            ['Manufacturing', 'Reliable, repeatable heat for production lines that demand consistent quality at every cycle.', 'factory', 3],
            ['Forging Industry', 'Rapid billet and bar heating for forging, upsetting and hot forming with minimal scale.', 'hammer', 4],
            ['Heat Treatment', 'Controlled hardening, annealing, tempering and stress relief for critical components.', 'flame', 5],
            ['Engineering Workshops', 'Compact, versatile induction systems for fabrication, repair and job-shop applications.', 'wrench', 6],
            ['Industrial Production', 'Scalable heating solutions engineered around continuous, high-volume production requirements.', 'cog', 7],
        ];

        foreach ($industries as [$title, $description, $icon, $order]) {
            Industry::updateOrCreate(
                ['title' => $title],
                ['description' => $description, 'icon' => $icon, 'sort_order' => $order, 'is_active' => true]
            );
        }

        $whyChoose = [
            ['Advanced Technology', 'Modern IGBT power electronics, digital control and application-specific coil design deliver stable, efficient heating.', 'cpu', 1],
            ['Reliable Performance', 'Industrial-grade components and rigorous testing keep your machine productive through demanding production schedules.', 'shield-check', 2],
            ['Energy Efficiency', 'High power-conversion efficiency and targeted heating reduce energy waste and lower operating costs.', 'zap', 3],
            ['Precision Heating', 'Tight temperature and power control produce repeatable results, cycle after cycle, part after part.', 'target', 4],
            ['Quality Engineering', 'Every system is engineered, assembled and inspected to documented quality standards before dispatch.', 'award', 5],
            ['Customer Support', 'From application review to commissioning and after-sales service, our engineers stay involved.', 'headset', 6],
        ];

        foreach ($whyChoose as [$title, $description, $icon, $order]) {
            WhyChooseItem::updateOrCreate(
                ['title' => $title],
                ['description' => $description, 'icon' => $icon, 'sort_order' => $order, 'is_active' => true]
            );
        }

        $gallery = [
            ['Induction heating in production', 'seed/gallery-1.jpg', 1],
            ['Industrial manufacturing floor', 'seed/gallery-2.jpg', 2],
            ['Precision metal processing', 'seed/gallery-3.jpg', 3],
            ['Engineering and quality inspection', 'seed/gallery-4.jpg', 4],
            ['Machine assembly and testing', 'seed/gallery-5.jpg', 5],
            ['Production facility', 'seed/gallery-6.jpg', 6],
            ['On-site engineering support', 'seed/gallery-7.jpg', 7],
            ['Induction heating machine line', 'seed/machine-line.jpg', 8],
        ];

        foreach ($gallery as [$title, $image, $order]) {
            GalleryImage::updateOrCreate(
                ['image' => $image],
                ['title' => $title, 'alt_text' => $title, 'sort_order' => $order, 'is_active' => true]
            );
        }
    }
}
