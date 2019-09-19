<?php

// Module ACL definitions.
$this("acl")->addResource('moderation', [
  'manage',
  'publish',
  'unpublish'
]);

/**
 * Add moderation markup to collections sidebar.
 */
$this->on('collections.entry.aside', function() {
  $this->renderView("moderation:views/partials/entry-aside.php");
});

/**
 * Initialize addon for admin pages.
 */
$app->on('admin.init', function () use ($app)  {
  // Check moderation capabilities for the user.
  $canPublish = $app->module('cockpit')->hasaccess('moderation', ['manage', 'publish']);
  $canUnpublish = $app->module('cockpit')->hasaccess('moderation', ['manage', 'unpublish']);

  $this('admin')->data["extract/moderation"] = [
    'canPublish' => $canPublish,
    'canUnpublish' => $canUnpublish,
  ];

  // Add field tag.
  $this->helper('admin')->addAssets('moderation:assets/field-moderation.tag');
  $this->helper('admin')->addAssets('moderation:assets/moderation.css');
  $this->helper('admin')->addAssets('moderation:assets/moderation.js');
  // Bind admin routes.
  $this->bindClass('Moderation\\Controller\\Admin', 'settings/moderation');
});

/*
 * Add menu entry if the user has access to group stuff.
 */
$this->on('cockpit.view.settings.item', function () use ($app) {
  if ($app->module('cockpit')->hasaccess('moderation', 'manage')) {
     $this->renderView("moderation:views/partials/settings.php");
  }
});

/**
 * Provide modififications on the preview url (Helpers addon).
 */
$this->on('helpers.preview.url', function(&$preview) use ($app) {
  $keys = $app->module('cockpit')->loadApiKeys();
  $preview['token'] = $keys['moderation'] ?? '';
});

