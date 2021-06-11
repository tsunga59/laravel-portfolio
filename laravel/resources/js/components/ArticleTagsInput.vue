<template>
  <div>
    <input
      type="hidden"
      name="tags"
      :value="tagsJson"
    >
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      placeholder="タグを追加する"
      :autocomplete-items="filteredItems"
      @tags-changed="newTags => tags = newTags"
    />
  </div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
  components: {
    VueTagsInput,
  },
  data() {
    return {
      tag: '',
      tags: [],
      autocompleteItems: [{
        text: 'Spain',
      }, {
        text: 'France',
      }, {
        text: 'USA',
      }, {
        text: 'Germany',
      }, {
        text: 'China',
      }],
    };
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
    tagsJson() {
        return JSON.stringify(this.tags)
    }
  },
};
</script>

<style lang="css">
  .vue-tags-input .ti-input {
    padding: 8px 10px;
    border: 1px solid #646E72;
    border-radius: 5px;
  }
  .vue-tags-input .ti-input .ti-tag {
    font-size: 1.5rem;
    color: #15847B;
    background-color: transparent;
    padding: 3px 8px;
    box-sizing: border-box;
    border: 1px solid #15847B;
    border-radius: 5px;
  }
  .vue-tags-input .ti-input .ti-tag.ti-deletion-mark {
    color: #fff;
    background-color: #E0351E;
    border: none;
  }
  .vue-tags-input .ti-input .ti-new-tag-input {
    font-size: 1.6rem;
    color: #333;
  }
</style>