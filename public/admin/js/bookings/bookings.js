const vue = new Vue({
  el: '#app',
  data: {
    loading: false,
    clientLoading: false,
    userRoles: role,
    users: [],
    selectedUsers: defaultClient,
    errors: '',
    selectedCategory: '',
    selectedSubcategory: '',
    subCategories: [],
    selectedCategorySubCategories: defaultCatSubCat,
    selectedState: state,
    regions: [],
    selectedRegion: defaultRegion,
  },
  mounted: function() {
    this.getUsers();
    this.getRegions();
  },
  methods: {
    getUsers(){
      let self = this;
      this.clientLoading = true;
      axios.get('/administrator/bookings/getUsers/', {
        params: {
          role: this.userRoles
        }
      })
        .then(function(response) {
          self.users = response.data;
          self.clientLoading = false;
        })
        .catch(function(error) {

        });
    },
    getRegions(){
      let self = this;
      axios.get('/administrator/bookings/getRegions/', {
        params: {
          state: this.selectedState
        }
      })
        .then(function(response) {
          self.regions = response.data;
        })
        .catch(function(error) {

        });
    },
    getSubcategories(){
      let self = this;
      this.loading = true;
      axios.get('/administrator/subcategories/getbycategoryid/', {
        params: {
          category_id: (this.selectedCategory) ? this.selectedCategory : 0
        }
      })
        .then(function(response) {
          self.loading = false;
          self.subCategories = response.data;
        })
        .catch(function(error) {

        });
    },
    addCategorySubCategory(){
      if (this.selectedCategory == 0) {
        this.errors = 'Please Select Category';
        return;
      }
      if (this.selectedSubcategory == 0) {
        this.errors = 'Please Select Sub Category';
        return;
      }
      if (this.isExist(this.selectedCategory, this.selectedSubcategory)) {
        this.errors = 'Already selected this category and sub category.';
        return;
      }
      this.errors = '';
      this.selectedCategorySubCategories.push({
        categoryId: this.selectedCategory,
        category: $('#category').find('option:selected').text(),
        subCategoryId: this.selectedSubcategory,
        subCategory: $('#subcategory').find('option:selected').text(),
      });
    },
    removeCategorySubCategory: function(row) {
      let idx = this.selectedCategorySubCategories.indexOf(row);
      this.selectedCategorySubCategories.splice(idx, 1)
    },
    isExist: function(catId, subCatId) {
      let length = this.selectedCategorySubCategories.length;
      for (var i = 0; i < length; i++) {
        let row = this.selectedCategorySubCategories[i];
        if (row.categoryId == catId && row.subCategoryId == subCatId) return true;
      }
    }
  },
  watch: {
    userRoles: function() {
      this.$nextTick(() => {
        this.selectedUsers = '';
      })
    },
    selectedCategory: function() {
      this.$nextTick(() => {
        this.selectedSubcategory = '';
      })
    }
  },
});