<template>
  <div class="like">
    <button
      type="button"
    >
      <i 
       class="far fa-heart fa-lg"
       :class="{liked: this.hasLike}"
      />
    </button>
    <span>10</span>
  </div>
</template>

<script>
  export default {
    props: {
      initialHasLike: {
        type: Boolean,
        default: false,
      },
    },
    data() {
      return {
        hasLike: this.initialHasLike,
      }
    },
  }
</script>

<style lang="css">
</style>