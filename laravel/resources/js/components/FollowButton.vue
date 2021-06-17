<template>
  <div>
    <button
      class="follow-btn"
      :class="{'followed': this.hasFollowed}"
    >
      <i
        v-if="this.hasFollowed"
        class="fas fa-user-check"
        @click="unfollow()"
      />
      <i
        v-else
        class="fas fa-user-plus"
        @click="follow()"
      />
    {{ this.hasFollowed ? 'フォロー中' : 'フォロー' }}
    </button>
  </div>
</template>

<script>
  export default {
    props: {
      initialHasFollowed: {
        type: Boolean,
        default: false,
      },
    },
    data() {
      return {
        hasFollowed: this.initialHasFollowed,
      }
    },
  }
</script>