<template>
<div class="hola-container" style="margin-top:-12vh;">
<div  style="width:100%!important">
    <ClassTable />
</div>
<div class="hola-columns hola-card-stack" style="margin-top:1vh;margin-bottom:7vh;">
    <Messages />
    <Weather />
    <Clean />
    <QuickFeatures />
</div>
</div>
</template>

<script>
import Messages from '../components/Messages.vue';
import Weather from '../components/Weather.vue';
import Clean from '../components/Clean.vue';
import QuickFeatures from '../components/QuickFeatures.vue';
import ClassTable from '../components/ClassTable.vue';
export default {
components: {
    Messages,
    Weather,
    Clean,
    QuickFeatures,
    ClassTable
  },
data: () => ({

}),
}
</script>

<style>

.feature-icon{
    display: inline-block;
    margin-left:40px;
    font-size:3.5rem;
    color:var(--hola-primary-color)!important;
}
.feature-name{
    display: inline-block;
    margin-left:30px;
    font-size:1.8rem;
    font-weight: 600;
    color: rgba(0, 0, 0, 0.6);
}
.clean-people{
    display: inline-block;
    margin-left: 20px;
    font-size: 2rem;
    color:rgba(0, 0, 0, 0.6);
    font-weight: 600;
}
.icon{
    display: inline-block;
    margin-bottom:3vw;
}
.icon-wrapper{
    color: #fff;
    height: 5.5vw;
    width: 5.5vw;
    border-radius: 50%;
    text-align: center;
    margin-right: .7rem;
    display: inline-block;
}
.hola-card-title{
    font-size: 3.5vw;
    font-family: "Montserrat";
}
ul>li{
    font-size: 1.5rem;
    color:#E57373;
    padding: 0 var(--hola-card-padding);
    display: block;
    line-height: 3em;
    overflow: hidden;
    text-decoration: none;
    text-overflow: ellipsis;
    transition: all .3s ease;
    white-space: nowrap;
}
</style>