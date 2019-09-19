<field-moderation class="field-moderation-field">
  <select ref="input" bind="{ opts.bind }">
    <option if="{App.$data.moderation.canPublish}" selected="{ parent.root.$value === opts.bind.value }" value="Unpublished">Unpublished</option>
    <option selected="{ parent.root.$value === opts.bind.value }" value="Draft">Draft</option>
    <option if="{App.$data.moderation.canUnpublish}" selected="{ parent.root.$value === opts.bind.value }" value="Published">Published</option>
  </select>

  <script>
    var $this = this;

    this.on('mount', function() {
      if (document.querySelector('.field-moderation-field')) {
        selector = document.querySelector('.field-moderation-field').closest(".uk-width-medium-1-1");
        selector && selector.classList.add('uk-hidden');
      }
      this.update();
    });

    this.$updateValue = function(value) {
      this.update();
    }.bind(this);

  </script>
</field-moderation>
