<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default website content
    |--------------------------------------------------------------------------
    | These values are used until an administrator saves content through the
    | CMS. The seeder also uses them to create the initial editable records.
    */

    'defaults' => [
        'company_name' => 'InduHeat Systems',
        'company_tagline' => 'Advanced Induction Heating Solutions',
        'company_short_description' => 'Engineering precision induction heating machinery for metal processing, forging, heat treatment and advanced industrial production.',
        'phone' => '+92 300 123 4567',
        'phone_secondary' => '+92 42 3567 8900',
        'email' => 'info@induheat.com',
        'email_secondary' => 'sales@induheat.com',
        'whatsapp_number' => '+92 300 123 4567',
        'address' => 'Plot 24, Industrial Estate, Kot Lakhpat, Lahore, Pakistan',
        'business_hours' => 'Monday – Saturday: 9:00 AM – 6:00 PM',
        'social_facebook' => 'https://www.facebook.com/',
        'social_linkedin' => 'https://www.linkedin.com/',
        'social_youtube' => 'https://www.youtube.com/',
        'social_instagram' => 'https://www.instagram.com/',
        'social_x' => '',
        'map_embed_url' => 'https://www.google.com/maps?q=Lahore%20Industrial%20Estate&output=embed',
        'footer_about' => 'InduHeat Systems designs and manufactures high-performance induction heating machinery for industrial applications worldwide. Precision engineered, dependable and built to perform.',
        'footer_copyright' => '© '.date('Y').' InduHeat Systems. All rights reserved.',
        'logo' => '',
        'favicon' => '',
        'seo_title' => 'InduHeat Systems | Advanced Induction Heating Machinery',
        'seo_description' => 'Precision-engineered induction heating machines for melting, forging, brazing, hardening and heat treatment. Explore industrial induction heating solutions from InduHeat Systems.',
        'seo_keywords' => 'induction heating machine, induction heater, induction melting furnace, induction forging, induction hardening, industrial heating equipment',
        'about_points' => "In-house engineering, design and manufacturing\nRigorous quality control at every production stage\nApplication-specific heating solutions\nResponsive technical support and global service",

        /* Navigation labels */
        'nav_home_label' => 'Home',
        'nav_about_label' => 'About Us',
        'nav_industries_label' => 'Industries',
        'nav_products_label' => 'Products',
        'nav_why_label' => 'Why Choose Us',
        'nav_contact_label' => 'Contact',
        'nav_gallery_label' => 'Gallery',
        'nav_cta_label' => 'Get a Quote',

        /* Buttons & small labels */
        'hero_primary_btn' => 'Explore Our Products',
        'hero_secondary_btn' => 'Request a Quote',
        'about_learn_more' => 'Learn More',
        'about_stat_value' => '20+',
        'about_stat_label' => 'Years of Industrial Heating Expertise',
        'products_all_label' => 'All Products',
        'products_view_all_label' => 'View All Products',
        'products_view_details_label' => 'View Details',
        'products_featured_label' => 'Featured',
        'products_empty_label' => 'No products found for this category.',
        'products_page_empty_label' => 'No products found.',
        'products_search_placeholder' => 'Search products...',
        'products_search_btn' => 'Search',
        'products_no_categories' => 'No categories yet.',
        'industries_empty_label' => 'Industries coming soon.',
        'why_empty_label' => 'Why Choose Us content coming soon.',
        'gallery_empty_label' => 'Gallery images coming soon.',
        'cta_btn_label' => 'Request a Quote',

        /* Contact form & info */
        'contact_form_heading' => 'Send Us a Message',
        'contact_name_label' => 'Full Name',
        'contact_company_label' => 'Company Name',
        'contact_email_label' => 'Email Address',
        'contact_phone_label' => 'Phone Number',
        'contact_product_label' => 'Select Interested Product (optional)',
        'contact_message_label' => 'Your message or requirements',
        'contact_submit_label' => 'Send Message',
        'contact_info_heading' => 'Get In Touch',
        'contact_address_label' => 'Address',
        'contact_phone_info_label' => 'Phone',
        'contact_email_info_label' => 'Email',
        'contact_whatsapp_info_label' => 'WhatsApp',
        'contact_map_title' => 'Office location',

        /* Footer */
        'footer_about_heading' => 'About Us',
        'footer_quick_links_heading' => 'Quick Links',
        'footer_products_heading' => 'Products',
        'footer_contact_heading' => 'Contact',
        'footer_social_heading' => 'Follow Us',

        /* Product detail page */
        'product_overview_heading' => 'Overview',
        'product_specs_heading' => 'Technical Specifications',
        'product_features_heading' => 'Features',
        'product_applications_heading' => 'Applications',
        'product_no_images_label' => 'No additional images.',
        'product_custom_heading' => 'Need a Custom Heating Solution?',
        'product_custom_text' => 'Share your part details, production target and material. Our engineers will recommend the right machine, coil and process settings for your operation.',
        'product_quote_btn' => 'Request a Quote',
        'product_whatsapp_btn' => 'WhatsApp Inquiry',
        'product_related_heading' => 'Related Machinery',
        'product_related_empty' => 'No related machinery found.',
        'product_breadcrumb_label' => 'Products',
    ],

    'sections' => [
        'hero' => [
            'eyebrow' => 'Precision Induction Technology',
            'heading' => 'Advanced Induction Heating Solutions',
            'sub_heading' => 'Precision Engineering. Efficient Heating. Industrial Performance.',
            'content' => 'We provide advanced induction heating machinery designed for precision, efficiency, reliability, and demanding industrial applications.',
            'image' => 'seed/hero-induction.jpg',
        ],
        'about' => [
            'eyebrow' => 'About InduHeat',
            'heading' => 'Engineering the Future of Industrial Heating',
            'sub_heading' => 'Purpose-built machinery, engineered around your process.',
            'content' => "InduHeat Systems is a specialist manufacturer of induction heating machinery for metal processing and industrial production. From compact 15 kW units to high-capacity systems, every machine is engineered for consistent heat, efficient power use and dependable round-the-clock operation.\n\nOur team combines power electronics, thermal engineering and hands-on industrial experience to deliver equipment that performs in real production environments — not just on paper. From the first application review to commissioning and after-sales support, we work as an extension of your engineering team.",
            'image' => 'seed/about-machine.jpg',
        ],
        'products' => [
            'eyebrow' => 'Our Machinery',
            'heading' => 'Induction Heating Machines Built for Performance',
            'sub_heading' => 'Explore our range of precision induction systems — engineered for repeatable results, low energy consumption and long service life.',
            'content' => '',
            'image' => '',
        ],
        'industries' => [
            'eyebrow' => 'Industries We Serve',
            'heading' => 'Powering Critical Industrial Processes',
            'sub_heading' => 'Our induction heating systems are trusted across metal-intensive industries where temperature control, speed and reliability directly affect the finished part.',
            'content' => '',
            'image' => '',
        ],
        'why_choose' => [
            'eyebrow' => 'Why Choose Us',
            'heading' => 'Engineered Advantage, Proven in Production',
            'sub_heading' => 'We combine advanced power electronics with practical engineering to deliver induction heating systems that keep your operation productive.',
            'content' => '',
            'image' => '',
        ],
        'gallery' => [
            'eyebrow' => 'Machinery Gallery',
            'heading' => 'Inside Our Engineering & Production',
            'sub_heading' => 'A closer look at the machines, applications and precision work behind every InduHeat system.',
            'content' => '',
            'image' => '',
        ],
        'cta' => [
            'eyebrow' => 'Start a Conversation',
            'heading' => 'Looking for the Right Induction Heating Solution?',
            'sub_heading' => '',
            'content' => 'Contact our team to discuss your industrial heating requirements. We will help you specify the right machine, coil and process parameters for your application.',
            'image' => 'seed/cta-welding.jpg',
        ],
        'contact' => [
            'eyebrow' => 'Contact Us',
            'heading' => 'Let’s Talk About Your Heating Application',
            'sub_heading' => 'Share your process, material and production targets. Our engineers will respond with the right solution.',
            'content' => '',
            'image' => '',
        ],
    ],

];
