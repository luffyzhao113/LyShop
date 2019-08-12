<template>
    <div class="search-panel">
      <Form ref="formSearch" :model="value" inline :label-width="60">
        <slot></slot>
      </Form>
    </div>
</template>

<script>

  export default {
    name: "i-search",
    props: {
      value: {
        type: Object
      }
    }
  }
</script>

<style scoped >
    .search-panel{
        padding: 10px;
    }
</style>
<style lang="less">
    .search-panel {
        background-color: #fff;
        .ivu-form-item{
            margin-bottom: 0px;
        }
        .ivu-cascader{
            display: inline-block;
        }
    }
</style>