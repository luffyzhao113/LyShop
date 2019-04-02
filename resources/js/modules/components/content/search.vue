<template>
  <Card :title="title" :icon="icon">
      <Form ref="formSearch" :model="value" inline :label-width="60">
        <slot></slot>
      </Form>
  </Card>

</template>

<script>

  export default {
    name: "i-search",
    props: {
      value: {
        type: Object
      },
      title: {
        type: String,
        default: '搜索'
      },
      icon: {
        type: String,
        default: 'ios-search'
      }
    }
  }
</script>

<style scoped lang="less">
</style>