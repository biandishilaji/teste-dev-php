<template>
  <div>
      <span :class="['bar', type || '']"></span>
  </div>

</template>
<script>


export default {
  name: 'SkeletonComponents',
  props: ['type', 'values', 'name', 'list_checks'],
  components: {
    // List,
    // Widgets
  },
  data(){
    return {
    }
  },
  updated () {
  },
}
</script>
<style>

.bar {
  width: 100%;
  border-radius: 4px;
  display: block;
  margin: 5px 5px 5px 5px;
  background: #ecf0f1;
  transition: 1s all ease-out;
  -webkit-animation-name: linear-bg;
  animation-name: linear-bg;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-direction: alternate;
  animation-direction: alternate;
}
.text {
  height: 15px;
}
.small {
  height: 12px;
}
.button {
  height: 27px;
}
.bar.circle {
  width: 45px;
  height: 45px;
  border-radius: 100%;
}
.bar.square {
  width: 40px;
  height: 40px;
  border-radius: 20%;
}


@media screen and (min-width: 768px) and (max-width: 1024px){
  .bar {
    width: 100%;
    height: 10px;
    border-radius: 4px;
    display: flex;
    margin: 5px 5px 5px 5px;
    background: #ecf0f1;
    transition: 1s all ease-out;
    -webkit-animation-name: linear-bg;
    animation-name: linear-bg;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-direction: alternate;
    animation-direction: alternate;
  }
  .bar.circle {
    width: 30px;
    height: 30px;
    border-radius: 100%;
  }
  .bar.square {
    margin-top: 10px;
    width: 30px;
    height: 30px;
    border-radius: 20%;
  }
}


@-webkit-keyframes linear-bg {
  from {
    background: #ecf0f1;
  }
  100% {
    background: #DDD;
  }
}

@keyframes linear-bg {
  from {
    background: #ecf0f1;
  }
  100% {
    background: #DDD;
  }
}


</style>
