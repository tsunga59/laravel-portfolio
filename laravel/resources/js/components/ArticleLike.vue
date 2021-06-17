<template>
  <div class="like">
    <button
      type="button"
    >
      <i
       v-if="this.hasLike"
       class="fas fa-heart fa-lg liked animation"
       @click="unlike()"
      />
      <i
       v-else
       class="far fa-heart fa-lg"
       @click="like()"
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
        hasLike: this.initialHasLike,
        countLikes: this.initialCountLikes,
      }
    },
    methods: {
      async like() {
        if(!this.authorized) {
          alert('いいねをするにはログインが必要です。')
          return
        }
        
        await axios.put(this.endpoint)
         .then(res => {
          this.hasLike = true
          this.countLikes = res.data.countLikes
         })
      },
      async unlike() {
        await axios.delete(this.endpoint)
         .then(res => {
          this.hasLike = false
          this.countLikes = res.data.countLikes
         })
      },
    }
  }
</script>