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
    <span>{{ countLikes }}</span>
  </div>
</template>

<script>
  export default {
    props: {
      initialHasLike: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default: 0,
      },
    },
    data() {
      return {
        hasLike: this.initialHasLike,
        countLikes: this.initialHasLike,
      }
    },
  }
</script>

<style lang="css">
</style>