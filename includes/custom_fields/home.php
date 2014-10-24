<?php

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_hero-background-image',
    'title' => 'Hero Background Image',
    'fields' => array (
      array (
        'key' => 'field_540cbe61e97eb',
        'label' => 'Hero Background',
        'name' => 'hero_background',
        'type' => 'image',
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array (
    'id' => 'acf_primary-nav',
    'title' => 'Primary Nav',
    'fields' => array (
      array (
        'key' => 'field_540cbcc784b7d',
        'label' => 'Nav Tagline',
        'name' => 'nav_tagline',
        'type' => 'text',
        'instructions' => 'Text in top right of nav.',
        'default_value' => 'A Social Media Company',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cbcee84b7e',
        'label' => 'Logo',
        'name' => 'logo',
        'type' => 'image',
        'instructions' => 'Your logo for the primary nav.',
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 1,
  ));
  register_field_group(array (
    'id' => 'acf_hero-taglines',
    'title' => 'Hero Taglines',
    'fields' => array (
      array (
        'key' => 'field_540cbb1b65f6d',
        'label' => 'Hero Large',
        'name' => 'hero_large',
        'type' => 'text',
        'default_value' => 'Tired of social not helping your bottom line?',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cbb5165f6e',
        'label' => 'Hero Regular',
        'name' => 'hero_regular',
        'type' => 'text',
        'default_value' => 'Unlock your full social marketing power with a focused strategy and execution',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cbb7565f6f',
        'label' => 'Hero Small Bold',
        'name' => 'hero_small_bold',
        'type' => 'text',
        'default_value' => 'The only partner focused entirely on your ROI',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 2,
  ));
  register_field_group(array (
    'id' => 'acf_hero-form',
    'title' => 'Hero Form',
    'fields' => array (
      array (
        'key' => 'field_540cc29f4d929',
        'label' => 'Hero Form Main Tagline',
        'name' => 'hero_form_main_tagline',
        'type' => 'text',
        'default_value' => 'Stop losing time and money with social.',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cc3074d92a',
        'label' => 'Hero Form Sub Tagline',
        'name' => 'hero_form_sub_tagline',
        'type' => 'text',
        'default_value' => 'Get an initial assessment <span class="orange-underline">free.</span>',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cc3434d92b',
        'label' => 'Assessment Price',
        'name' => 'assessment_price',
        'type' => 'text',
        'default_value' => 299,
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 3,
  ));
  register_field_group(array (
    'id' => 'acf_services-taglines',
    'title' => 'Services Taglines',
    'fields' => array (
      array (
        'key' => 'field_541f9d604e6e5',
        'label' => 'Main Tagline',
        'name' => 'services_main_tagline',
        'type' => 'text',
        'default_value' => 'What We Offer',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541f9d964e6e6',
        'label' => 'Sub Tagline',
        'name' => 'services_sub_tagline',
        'type' => 'text',
        'default_value' => 'In a nutshell, we use social media to deliver real business results and drive your bottom line. ROI is King.',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 4,
  ));


  register_field_group(array (
    'id' => 'acf_service-1',
    'title' => 'Service 1',
    'fields' => array (
      array (
        'key' => 'field_541fa3fe4e697',
        'label' => 'Service Title',
        'name' => 'service_title_1',
        'type' => 'text',
        'default_value' => 'Strategy Development <br>& Execution',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541fa4344e698',
        'label' => 'Service Short Description',
        'name' => 'service_short_description_1',
        'type' => 'text',
        'default_value' => 'We develop and present a complete strategy tailored to your business objectives. This is a one of a kind Expect a thorough competitive analysis, content marketing plan, audience research, advertising campaign proposals, ROI tracking and detailed execution plan. This one of a kind document is designed in such a way that you can easily hand it off to your internal marketing team for execution, or let us manage it entirely on your behalf.',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541fa45e4e699',
        'label' => 'Service Expanded Info',
        'name' => 'service_expanded_info_1',
        'type' => 'wysiwyg',
        'default_value' => '<p>Before you start doing social, you need to know what you should be doing. Do you know where you stand among your competitors? What are the industry leaders doing? What are you immediate opportunities? How many resources will you require to get where you need to be? How will you measure results? We will answer these and many other questions in this all-inclusive document. </p>

  <p>Check out this short video to learn more about our approach to social media strategy development</p>

  <p>http://www.youtube.com/watch?v=VkxYGJk9pwE</p>',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 5,
  ));


  register_field_group(array (
    'id' => 'acf_service-2',
    'title' => 'Service 2',
    'fields' => array (
      array (
        'key' => 'field_541fa3fe4e6972',
        'label' => 'Service Title',
        'name' => 'service_title_2',
        'type' => 'text',
        'default_value' => 'Advertising <br>Campaigns',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541fa4344e6982',
        'label' => 'Service Short Description',
        'name' => 'service_short_description_2',
        'type' => 'text',
        'default_value' => 'Reach your target audience where they spend their time – online and on mobile devices. Social media advertising is only a few years old, and we were there from the beginning. Let us show you how to drive converting traffic from social networks into your e-commerce channel with an effective pay-per-click advertising campaign.',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541fa45e4e6992',
        'label' => 'Service Expanded Info',
        'name' => 'service_expanded_info_2',
        'type' => 'wysiwyg',
        'default_value' => '<p>If you are investing in any form of digital marketing, you cannot ignore smartphones, tablets or social media advertising. After all, 78% of social media users access these networks through their mobile devices. Social media advertising is our specialty, and we’ve been doing it since it became available for the first time in 2010. Whether it is a campaign on Facebook, LinkedIn, Twitter, Instagram or another social network, we will build the right approach for your business, your industry, and your specific audience. With detailed conversion tracking, you will know exactly what you are getting out of every dollar spent.</p>

  <p>Watch this short video to learn more about our approach to social media advertising.</p>

  <p>http://www.youtube.com/watch?v=l9JzRzKlmfs</p>',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 6,
  ));



  register_field_group(array (
    'id' => 'acf_service-3',
    'title' => 'Service 3',
    'fields' => array (
      array (
        'key' => 'field_541fa3fe4e69723',
        'label' => 'Service Title',
        'name' => 'service_title_3',
        'type' => 'text',
        'default_value' => 'Consulting &<br>Training Services',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541fa4344e69823',
        'label' => 'Service Short Description',
        'name' => 'service_short_description_3',
        'type' => 'text',
        'default_value' => 'We pride ourselves on being more than a vendor. We are a partner. Social media is a fast moving machine, and to gain a true competitive advantage, you need to be ahead of the curve. We are not a digital marketing company, we are a social media company. Social is ALL we do, and this allows us to be the best at it. Tap into our top industry talent for an internal marketing workshop or assistance with your next product launch.',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541fa45e4e69923',
        'label' => 'Service Expanded Info',
        'name' => 'service_expanded_info_3',
        'type' => 'wysiwyg',
        'default_value' => '<p>As your partner, our job is to equip you with world class social media. That means, you can ask us anything. Our approach and deliverables are always tailored to your business needs. Below are some of the common consulting and training services that our clients tap into:</p>
                                        <ul>
                                          <li>Short term campaigns for product launches</li>
                                          <li>Running contests or special promotions</li>
                                          <li>Internal training on various social media topics</li>
                                          <li>Helping your sales team get the most out of social</li>
                                          <li>Equipping your team with analytical tools</li>
                                          <li>Technical training on management tools</li>
                                          <li>Proper ROI tracking guidance</li>
                                          <li>Guest speaking at seminars and internal workshops</li>
                                          <li>Community management best practices</li>
                                          <li>Fusing social with your customer service team </li>
                                          <li>Much more!</li>
                                        </ul>',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 7,
  ));
  register_field_group(array (
    'id' => 'acf_why-us-taglines',
    'title' => 'Why Us Taglines',
    'fields' => array (
      array (
        'key' => 'field_542e264ec1642',
        'label' => 'Main Tagline',
        'name' => 'why_us_main_tagline',
        'type' => 'text',
        'default_value' => 'Why Us',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_542e274bc1643',
        'label' => 'Sub Tagline',
        'name' => 'why_us_sub_tagline',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 8,
  ));
  register_field_group(array (
    'id' => 'acf_why-us-points',
    'title' => 'Why Us Points',
    'fields' => array (
      array (
        'key' => 'field_542e2bcda776c',
        'label' => 'Why Us Point 1 Title',
        'name' => 'why_us_point_1_title',
        'type' => 'text',
        'default_value' => 'Social is All We Do',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_542e2bfca776d',
        'label' => 'Why Us Point 1 Content',
        'name' => 'why_us_point_1_content',
        'type' => 'textarea',
        'default_value' => 'We are not a Jack of all trades. We don’t do web design or Google Ads or SEO. Instead, we’ve mastered social media.',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'br',
      ),
      array (
        'key' => 'field_542e2c19a776e',
        'label' => 'Why Us Point 2 Title',
        'name' => 'why_us_point_2_title',
        'type' => 'text',
        'default_value' => 'ROI Driven',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_542e2c22a776f',
        'label' => 'Why Us Point 2 Content',
        'name' => 'why_us_point_2_content',
        'type' => 'textarea',
        'default_value' => 'We track every dollar invested with established analytics and reporting. Everything is aimed at driving the bottom line for your business.',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'br',
      ),
      array (
        'key' => 'field_542e2c34a7770',
        'label' => 'Why Us Point 3 Title',
        'name' => 'why_us_point_3_title',
        'type' => 'text',
        'default_value' => 'Social Advertising Pioneers',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_542e2c3ba7771',
        'label' => 'Why Us Point 3 Content',
        'name' => 'why_us_point_3_content',
        'type' => 'textarea',
        'default_value' => 'Social media pay-per-click is a new product only a few years old, and we were there from the beginning. If you are going to spend dollars on social advertising, you want us on your side.',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'br',
      ),
      array (
        'key' => 'field_542e2c42a7772',
        'label' => 'Why Us Point 4 Title',
        'name' => 'why_us_point_4_title',
        'type' => 'text',
        'default_value' => 'Top Industry Talent',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_542e2c49a7773',
        'label' => 'Why Us Point 4 Content',
        'name' => 'why_us_point_4_content',
        'type' => 'textarea',
        'default_value' => 'We\'ve collected world class advertisers, creative thinkers, graphic designers, copywriters, community managers and analysts, to equip your business with a World Class social media presence.',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'br',
      ),
      array (
        'key' => 'field_542e2c52a7774',
        'label' => 'Why Us Point 5 Title',
        'name' => 'why_us_point_5_title',
        'type' => 'text',
        'default_value' => 'Proven Track Record',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_542e2c5ca7775',
        'label' => 'Why Us Point 5 Content',
        'name' => 'why_us_point_5_content',
        'type' => 'textarea',
        'default_value' => 'We’ve helped numerous businesses achieve their business goals, developing long term relationships along the way.',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'br',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 9,
  ));
  register_field_group(array (
    'id' => 'acf_clients-taglines',
    'title' => 'Clients Taglines',
    'fields' => array (
      array (
        'key' => 'field_542e264ewef7w8c1642',
        'label' => 'Main Tagline',
        'name' => 'clients_main_tagline',
        'type' => 'text',
        'default_value' => 'Our Happy Clients',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_542e274bc1wrv79643',
        'label' => 'Sub Tagline',
        'name' => 'clients_sub_tagline',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 10,
  ));
  register_field_group(array (
    'id' => 'acf_clients',
    'title' => 'Clients',
    'fields' => array (
      array (
        'key' => 'field_543c4306957c4',
        'label' => 'Clients',
        'name' => 'clients',
        'type' => 'repeater',
        'sub_fields' => array (
          array (
            'key' => 'field_543c4316957c5',
            'label' => 'Client Logo',
            'name' => 'client_logo',
            'type' => 'image',
            'instructions' => 'Upload client logo',
            'column_width' => '',
            'save_format' => 'url',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),
          array (
            'key' => 'field_543c435d957c6',
            'label' => 'Client URL',
            'name' => 'client_url',
            'type' => 'text',
            'instructions' => 'Link to client site (optional)',
            'column_width' => '',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
          ),
        ),
        'row_min' => '',
        'row_limit' => '',
        'layout' => 'table',
        'button_label' => 'Add Row',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 11,
  ));

  register_field_group(array (
    'id' => 'acf_blog-cards',
    'title' => 'Blog Cards',
    'fields' => array (
      array (
        'key' => 'field_542e2jfweouhf864ewef7w8c1642',
        'label' => 'Main Tagline',
        'name' => 'blog_main_tagline',
        'type' => 'text',
        'default_value' => 'From the Blog',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_542eijoof8l0274bc1wrv79643',
        'label' => 'Sub Tagline',
        'name' => 'blog_sub_tagline',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_543c98d2008e2',
        'label' => 'Essential Grid Shortcode',
        'name' => 'essential_grid_shortcode',
        'type' => 'text',
        'instructions' => 'Copy and paste in the essential grid shortcode.',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 1,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 12,
  ));
}
