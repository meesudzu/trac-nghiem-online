/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for a single toolbar row.
    config.toolbarGroups = [{
            name: 'document',
            groups: ['mode', 'document', 'doctools']
        },
        {
            name: 'clipboard',
            groups: ['clipboard', 'undo']
        },
        {
            name: 'editing',
            groups: ['find', 'selection', 'spellchecker']
        },
        {
            name: 'forms'
        },
        {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup']
        },
        {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align', 'bidi']
        },
        {
            name: 'links'
        },
        {
            name: 'insert'
        },
        {
            name: 'styles'
        },
        {
            name: 'colors'
        },
        {
            name: 'tools'
        },
        {
            name: 'others'
        },
        {
            name: 'about'
        }
    ];

    // The default plugins included in the basic setup define some buttons that
    // are not needed in a basic editor. They are removed here.
    config.removeButtons = 'Anchor,Link,Unlink';

    // Dialog windows are also simplified.
    config.removeDialogTabs = 'link:advanced';
    config.extraPlugins = 'mathjax';
    config.extraPlugins = 'widget';
    config.extraPlugins = 'widgetselection';
    config.extraPlugins = 'lineutils';
    config.mathJaxLib = '/res/libs/MathJax/MathJax.js?config=TeX-MML-AM_CHTML';
    config.mathJaxClass = 'math-tex';
    config.extraPlugins = 'format';
    config.extraPlugins = 'stylescombo';
    config.extraPlugins = 'richcombo';
    config.extraPlugins = 'button';
    config.extraPlugins = 'floatpanel';
    config.extraPlugins = 'panel';
    config.extraPlugins = 'listblock';
    config.extraPlugins = 'image';
    config.entities_latin = false;
    config.basicEntities = false;
    config.entities = false;
    config.entities_greek = false;
    config.forceSimpleAmpersand = false;
    config.entities_processNumerical = true;
    config.htmlEncodeOutput = false;
};