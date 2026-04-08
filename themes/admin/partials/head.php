<!--begin::Head-->
<head>
    <base href="<?= base_url(); ?>"/>
    <title><?= (isset($setting->meta_title)) ? ucwords($setting->meta_title) : ''; ?><?= (isset($title)) ? ' | '.$title : ''; ?></title>
    <meta charset="utf-8" />
    <?php if(isset($setting->meta_description) && $setting->meta_description) : ?>
    <meta name="description" content="<?= $setting->meta_description; ?>" />
    <?php endif;?>
    <?php if(isset($setting->meta_keyword) && $setting->meta_keyword) : ?>
    <meta name="keywords" content="<?= $setting->meta_keyword ?>" />
    <?php endif;?>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

     <!-- UNTUK SEO -->
    <?php if(isset($setting->icon) && $setting->icon) : ?>
    <link rel="shortcut icon" href="<?= image_check($setting->icon,'setting'); ?>" />
    <?php endif;?>

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="<?= base_url('assets/public/plugins/custom/datatables/datatables.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link rel="stylesheet" href="<?= base_url('assets/base_color/color.css'); ?>" />
    <link href="<?= base_url('assets/public/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/public/plugins/custom/vis-timeline/vis-timeline.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/public/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/public/css/custom_pribadi.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/public/css/loading_custom.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script type="text/javascript" src="<?= base_url('assets/public/plugins/ckeditor5/ckeditor.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/public/plugins/ckeditor5/ckeditor.js');?>"></script>
    <script>
        var CKEditor_tool = [
            "heading", 
            "|", 
            "fontSize", "fontFamily", "fontColor", "fontBackgroundColor", 
            "|", 
            "bold", "italic", "underline", "strikethrough", "subscript", "superscript", 
            "|", 
            "alignment", 
            "|", 
            "bulletedList", "numberedList", "todoList", 
            "|", 
            "outdent", "indent", 
            "|", 
            "blockQuote", "insertTable", "codeBlock", 
            "|", 
            "horizontalLine", "specialCharacters", "pageBreak", 
            "|", 
            "undo", "redo", "selectAll", "removeFormat"
        ];

        var font_color =  [
            {
                color: 'hsl(0, 0%, 0%)',
                label: 'Black'
            },
            {
                color : 'hsl(0, 0%, 100%)',
                label : 'White'
            },
            {
                color: 'hsl(0, 75%, 60%)',
                label: 'Red'
            },
            {
                color: 'hsl(120, 75%, 60%)',
                label: 'Green'
            },
            {
                color: 'hsl(240, 75%, 60%)',
                label: 'Blue'
            },
            {
                color: 'hsl(60, 75%, 60%)',
                label: 'Yellow'
            },
            {
                color: 'hsl(235, 85%, 35%)',
                label : 'Primary'
            }
        ];
    </script>
    <?php
    if (isset($css_add) && is_array($css_add)) {
        foreach ($css_add as $css) {
            echo $css;
        }
    } else {
        echo (isset($css_add) && ($css_add != "") ? $css_add : "");
    }
    ?>
    <style>
        .cursor-pointer{
            cursor: pointer !important;
        }
        .cursor-disabled{
            cursor: not-allowed !important;
        }
        .cursor-scroll{
            cursor: all-scroll;
        }
        .menu-accordion.active{
            color : #FF286B !important;
        }
        .swal2-textarea{
            color : #FFFFFF !important;
        }
        .swal2-textarea {
            color : black !important;
        }
    </style>
</head>
<!--end::Head-->