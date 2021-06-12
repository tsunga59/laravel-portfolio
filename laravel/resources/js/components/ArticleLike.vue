<template>
  <div class="like">
    <button
      type="button"
    >
      <i
       v-if="this.hasLike"
       class="fas fa-heart fa-lg liked"
      />
      <i
       v-else
       class="far fa-heart fa-lg"
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