<template>
  <mu-container class="brand-intro">
    <h4 class="slogen anim" data-effect="fadeInUp" data-duration="1s">
      <span>{{$t('home.intro.slogen[0]')}}</span>
      <span style="margin-left: 1em;">{{$t('home.intro.slogen[1]')}}</span>
    </h4>
    <p v-for="(item, index) in $t('home.intro.desc')" :key="index" class="anim" data-effect="fadeInUp" data-duration="1s" >{{ item }}</p>
  </mu-container>
</template>

<style lang="less" scoped>
@import '../../styles/vars.less';

.brand-intro {
  text-align: center;
  background-color: @white;
  padding-top: 55px;
  padding-bottom: 52.5px;
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }

  .slogen {
    margin-bottom: 1em;
    font-size: 33px;
    line-height:1.5em;
    font-weight: 500;
    color: @black;
  }

  p {
    line-height: 3em;
    color: #595757;
  }
}

.sm .brand-intro {
  padding-top: 50px;
  padding-bottom: 30px;

  .slogen {
    font-size: 26px;
  }
}

.xs .brand-intro {
  padding-top: 40px;
  padding-bottom: 30px;

  .slogen {
    font-size: 24px;
  }
}
</style>
