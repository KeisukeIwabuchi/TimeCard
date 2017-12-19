<template lang="pug">
  .wrapper
    .main
      .group-name {{ team }}
      .border
      .date {{ nowDate }}
      .time {{ nowTime }}
      .border
      .btn__block
        .name {{ selectedMember }}
        .btn(:class="{active: isActiveAndLeave}" @click="arrival()") 出勤
        .btn(:class="{active: isActiveAndArrival}" @click="leave()") 退勤
    .sidebar
      .sidebar__title スタッフ一覧
      .sidebar__item-block
        .sidebar__item(
          v-for="member in members"
          @click="selectMember(member.id)"
          :class="{select: isSelect(member.name)}")
          label {{ member.name }}
          label.working(v-if="member.is_working") 出勤中
</template>

<script>
  // import axios from 'axios'
  export default {
    props: ['team'],
    data () {
      return {
        selectedMember: '',
        nowDate: '',
        nowTime: '',
        members: []
      }
    },
    computed: {
      isActiveAndLeave: function() {
        if (this.selectedMember.length === 0) {
          return false
        }
        for (var i = 0; i < this.members.length; i++) {
          if (this.members[i].name === this.selectedMember) {
            if (this.members[i].is_working == false) {
              return true
            }
          }
        }
        return false
      },
      isActiveAndArrival: function() {
        if (this.selectedMember.length === 0) {
          return false
        }
        for (var i = 0; i < this.members.length; i++) {
          if (this.members[i].name === this.selectedMember) {
            if (this.members[i].is_working == true) {
              return true
            }
          }
        }
        return false
      }
    },
    methods: {
      date: function() {
        let time = new Date()
        let year = time.getFullYear()
        let month = this.zeroPadding(time.getMonth() + 1)
        let date = this.zeroPadding(time.getDate())
        let day_of_week = time.getDay()
        let day = '日'
        switch (day_of_week) {
          case 0:
            day = '日'
            break
          case 1:
            day = '月'
            break
          case 2:
            day = '火'
            break
          case 3:
            day = '水'
            break
          case 4:
            day = '木'
            break
          case 5:
            day = '金'
            break
          case 6:
            day = '土'
            break
        }
        return year + '年' + month + '月' + date + '日（' + day + '）'
      },
      time: function() {
        let time = new Date()
        let hour = this.zeroPadding(time.getHours())
        let minutes = this.zeroPadding(time.getMinutes())
        let seconds = this.zeroPadding(time.getSeconds())
        return hour + ':' + minutes + ':' + seconds
      },
      zeroPadding: function(value) {
        if (value < 10) {
          return '0' + value
        }
        return value
      },
      selectMember: function(index) {
        for (var i = 0; i < this.members.length; i++) {
          if (this.members[i].id === index) {
            if (this.selectedMember === this.members[i].name) {
              this.selectedMember = ''
            } else {
              this.selectedMember = this.members[i].name
            }
          }
        }
      },
      arrival: function() {
        for (var i = 0; i < this.members.length; i++) {
          if (this.members[i].name === this.selectedMember) {
            window.axios.post('/time', {
              id: (i + 1),
              start_time: this.getTime()
            }).then((res) => {
              this.members[res.data - 1].is_working = true
            })
          }
        }
      },
      leave: function() {
        for (var i = 0; i < this.members.length; i++) {
          if (this.members[i].name === this.selectedMember) {
            window.axios.put('/time/' + (i + 1), {
              end_time: this.getTime()
            }).then((res) => {
              this.members[res.data - 1].is_working = false
            })
          }
        }
      },
      getTime: function() {
        let time = new Date();
        let year = time.getFullYear()
        let month = this.zeroPadding(time.getMonth() + 1)
        let date = this.zeroPadding(time.getDate())
        let hour = this.zeroPadding(time.getHours())
        let minutes = this.zeroPadding(time.getMinutes())
        let seconds = this.zeroPadding(time.getSeconds())
        
        return year + '-' + month + '-' + date + ' ' +
               hour + ':' + minutes + ':' + seconds
      },
      isSelect: function(name) {
        return (this.selectedMember === name) ? true : false
      }
    },
    created () {
      axios.get('/user')
      .then((res) => {
        console.log(res.data)
        this.members = res.data
      });
    },
    mounted () {
      setInterval(()=>{
        this.nowDate = this.date()
        this.nowTime = this.time()
      }, 100)
    }
  }
</script>

<style lang="stylus" scoped>
  .wrapper
    position relative
    width 100%
    height 100%
    background-color #85D417
    color #fff

  .main
    width calc(100% - 500px)
    height 100%
    padding 50px 0 0

  .sidebar
    position absolute
    top 0
    right 0
    z-index 1
    width 500px
    height 100%
    padding 50px 0 0
    box-shadow 0px 0px 8px 2px #666
    background-color #fff
    color #333;

    &__title
      margin 0 0 2px
      padding 10px 0
      background-color #85D417
      color #fff
      text-align center

    &__item-block
      overflow-y scroll

    &__item
      padding 15px 20px
      border-bottom 1px solid #eee

      &:hover, &.select
        background-color #85D417
        color #fff
      
      .working
        float right
        background-color #85D432
        padding 3px 6px
        border-radius 3px
        color #fff

  .border
    width 90%
    height 2px
    margin 40px auto
    background-color rgba(0, 0, 0, .2)

  .group-name
    margin 0 0 0 40px
    font-size 32px
  
  .date
    margin 0 0 0 40px
    font-size 20px

  .time
    margin 0 0 0 40px
    font-size 64px

  .btn__block
    width 360px
    margin 50px auto 0

  .name
    margin 0 0 10px
    font-size 30px
    text-align center

  .btn
    btn-size = 120px
    width btn-size
    height btn-size
    margin 0 60px 0 0
    padding 0
    border-radius (btn-size / 2)
    border 2px solid #fff
    font-size 18px
    line-height btn-size
    opacity .5

    &:hover
      color: #fff
      opacity .5

    &.active
      box-shadow 0 0 0 0 #000
      opacity 1

      &:hover
        background-color #fff
        color #85D417
</style>
