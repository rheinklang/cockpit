# Cockpit CMS Moderation Addon

This addon extends Cockpit CMS core functionality by introducing the possibility to have moderation of collections. It means that its possible to create collections with a status (Unpublished, Draft or Published) affecting the way that entries are retrieved:

- **Unpublished** - Any collection entry in unpublished state will be filtered out.
- **Draft** - Any collection entry in Draft that doesn't have a previous revision in published status will be also filtered out. If there is a previous revision with published status the revision will be returned instead. However on a scenario that we have a published > unpublished > draft sequence no entry will be returned.
- **Published** - They are always returned.

## Installation

1. Confirm that you have Cockpit CMS (Next branch) installed and working.
2. Download zip and extract to 'your-cockpit-docroot/addons' (e.g. cockpitcms/addons/Moderation, the addon folder name must be Moderation)
3. Edit one collection and confirm that you have a new field type (Moderation).
4. Access addon settings page (http://your-cockpit-site/settings/moderation) and confirm that page loads.

## Configuration

To use the main functionality of the addon no extra configuration is required.
To use the preview mode (Draft entries will be also returned) is required to configure an API key
on the addon settings page. You can use the moderation api key in your requests like:

```
http://your-cockpit-site/api/collections/get/<name>?token=<api-key>&previewToken=<moderation-api-key>
```

### Permissions

The following permissions (ACL's) are defined:

* **manage** - access to all moderation states and addons settings page
* **publish** - can change entries to Published state
* **unpublish** - can change entries to Unpublished state

Example of configuration for 3 groups of editors where `editor` can only create/update entries to `Draft` state, `approver` can create/update `Draft` and move to `Published` state, and finally `manager` can publish and unpublish entries.

```yaml
groups:
  editor:
  approver:
    moderation:
      publish: true
  manager:
    moderation:
      publish: true
      unpublish: true
```

By default admins have super access, any other groups that have not the permissions specificed in the configuration, can only create/edit
entries only in Draft mode.

## Usage

Add a new field to your collection of type Moderation:

![Moderation Field](https://monosnap.com/image/wbgrrxHnGsXTM2NyNIboNZJbwW1dgc.png)

And when editing a collection that is using that field a moderation section will be displaye in the sidebar:

![Draft mode](https://monosnap.com/image/EcIQatqowil0atxnc3Opr0TJtqLYIp.png)
![Change status](https://monosnap.com/image/rv9Tf4ughdm2CgZgdCb5E7crvJexrW.png)

You can name whatever you want for your moderation field, e.g. status, moderation, etc.. But you need to keep in mind
if you change the field later you may need to manually update all existing collection entries.

## Demo

[![Moderation Addon](http://img.youtube.com/vi/LywGxJqUJkg/0.jpg)](http://www.youtube.com/watch?v=LywGxJqUJkg "Moderation Addon")

## Copyright and license

Copyright 2018 pauloamgomes under the MIT license.
