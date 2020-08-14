let data = {
  name: name,
  selectedSubCategories: (typeof selectedSubCategories !== 'undefined') ? selectedSubCategories : ''
};

// Handling the categories create.
const categories = new Vue({
  el: '#new-categories',
  data: data,
  computed: {
    slug: function() {
      const slug = this.sanitizeTitle(this.name);
      return slug;
    }
  },
  methods: {
    sanitizeTitle: function(value) {
      value = value.replace(/^\s+|\s+$/g, ''); // trim
      value = value.toLowerCase();

      // remove accents, swap ñ for n, etc
      var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
      var to = "aaaaaeeeeeiiiiooooouuuunc------";
      for (var i = 0, l = from.length; i < l; i++) {
        value = value.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
      }

      value = value.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

      return value;
    }
  }
});