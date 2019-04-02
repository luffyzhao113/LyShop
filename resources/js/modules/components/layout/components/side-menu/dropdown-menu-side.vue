<template>
    <Dropdown class="collapsed-item" placement="right-start" transfer @on-click="onClick">
        <div><Icon :type="menu.icon" size="20"/></div>
        <DropdownMenu ref="dropdown-side" slot="list">
            <template v-for="(item, key) in menu.children" >
                <template v-if="item.children && item.children.length > 0">
                    <Dropdown placement="right-start" :key="key" class="tree-collapsed-item" @on-click="onClick">
                        <div>
                            <Icon :type="item.icon" style="vertical-align: initial;"/>
                            <span>{{item.name}}</span>
                            <Icon type="ios-arrow-dropright" style="vertical-align: initial;"/>
                        </div>
                        <DropdownMenu slot="list">
                            <DropdownItem  v-for="(val, k) in item.children"  :key="`${key}-${k}`" :name="val.link">
                                <Icon :type="val.icon" style="vertical-align: initial;"/>
                                <span>{{val.name}}</span>
                            </DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </template>
                <DropdownItem v-else :key="key" :name="item.link">
                    <Icon :type="item.icon" style="vertical-align: initial;"/>
                    <span>{{item.name}}</span>
                </DropdownItem>  
            </template>                  
        </DropdownMenu>
    </Dropdown>
</template>

<script>

export default {
    name: 'DropdownMenuSide',
    props: {
        menu: {
            type: Object,
            default: () => {}
        },
    },
    mounted () {
        this.$nextTick(() => {
            this.$refs['dropdown-side'].$parent.$el.style.overflow = 'visible'            
        })  
    },
    methods: {
        onClick(name){
            this.$emit('on-select', name);
        }
    }
}
</script>

<style lang="less">
.tree-collapsed-item{
    width: 100%;
    margin: 0;
    line-height: normal;
    padding: 7px 0 6px 16px;
    clear: both;
    font-size: 12px!important;
    white-space: nowrap;
    list-style: none;
    cursor: pointer;
    -webkit-transition: background .2s ease-in-out;
    transition: background .2s ease-in-out;
    .ivu-dropdown-rel{
        padding-right: 16px;
    }
}
</style>

