<template>
  <div>
    <button
      class="follow-btn"
      :class="{'followed': this.hasFollowed}"
      type="button"
      @click="hasFollowed ? unfollow() : follow()"
    >
      <i
        :class="this.hasFollowed ? 'fas fa-user-check' : 'fas fa-user-plus'"
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
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        hasFollowed: this.initialHasFollowed,
      }
    },
    methods: {
      async follow() {
        if(!this.authorized) {
          alert('フォローをするにはログインが必要です。')
          return
        }

        await axios.put(this.endpoint)
          .then(res => {
            this.hasFollowed = true
          });
      },
      async unfollow() {
        await axios.delete(this.endpoint)
          .then(res => {
            this.hasFollowed = false
          });
      }
    },
  }
</script>