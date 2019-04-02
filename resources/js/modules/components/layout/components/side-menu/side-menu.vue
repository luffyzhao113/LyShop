<template>
    <div>
        <Menu :active-name="active" theme="dark" width="auto" v-if="!isCollapsed" @on-select="routerPush">
            <template v-for="(menu, index) in data">
                <Submenu v-if="menu.children && menu.children.length > 0" :name="menu.link" :key="index">
                    <template slot="title">
                        <Icon :type="menu.icon"/>
                        <span>{{menu.name}}</span>
                    </template>
                    <template v-for="(item, key) in menu.children">
                        <MenuGroup :title="item.name" v-if="item.children  && item.children.length > 0"
                                   :key="`${index}-${key}`">
                            <MenuItem v-for="(val, i) in item.children" :name="val.link" :key="`${index}-${key}-${i}`">
                                <Icon :type="val.icon"/>
                                <span>{{val.name}}</span>
                            </MenuItem>
                        </MenuGroup>
                        <MenuItem v-else :name="item.link" :key="`${index}-${key}`">
                            <Icon :type="item.icon"/>
                            <span>{{item.name}}</span>
                        </MenuItem>
                    </template>
                </Submenu>
                <MenuItem v-else :name="menu.link" :key="index">
                    <Icon :type="menu.icon"/>
                    <span>{{menu.name}}</span>
                </MenuItem>
            </template>
        </Menu>
        <template v-else>
            <template v-for="(menu, index) in data">

                <DropdownMenuSide v-if="menu.children && menu.children.length > 0" :key="index" :menu=menu
                                  @on-select="routerPush"></DropdownMenuSide>
                <Tooltip v-else :key="index" :content="menu.name" class="collapsed-item" placement="right">
                    <div @click="routerPush(menu.link)">
                        <Icon :type="menu.icon" size="20"/>
                    </div>
                </Tooltip>

            </template>
        </template>
    </div>
</template>

<script>
    import DropdownMenuSide from "./dropdown-menu-side";
    import {mapGetters} from 'vuex'


    export default {
        name: 'SideMenu',
        components: {DropdownMenuSide},
        props: {
            data: {
                type: Array,
                default: () => []
            }
        },
        computed: {
            isCollapsed() {
                return this.$parent.value;
            },
            ...mapGetters({
                active: 'layout/active'
            })
        },
        methods: {
            routerPush(name) {
                this.$router.push({
                    name
                });
            }
        }
    }
</script>

<style lang="less" scoped>
    .ivu-menu-submenu,
    .ivu-menu-item {
        white-space: nowrap;
    }

</style>

<style lang="less">
    .collapsed-item {
        text-align: center;
        line-height: 49px;
        cursor: pointer;
        display: block;
        overflow: visible;

        .ivu-icon {
            color: #fff;
        }

        .ivu-tooltip-rel {
            display: block;
        }
    }

    .ivu-menu-dark {
        background-color: #000;
    }

    .ivu-menu-dark.ivu-menu-vertical .ivu-menu-opened {
        background-color: #0c212b;
    }

    .ivu-menu-dark.ivu-menu-vertical .ivu-menu-submenu .ivu-menu-item-active, .ivu-menu-dark.ivu-menu-vertical .ivu-menu-submenu .ivu-menu-item-active:hover {
        background-color: rgb(255, 153, 0) !important;
        color: #000!important;
    }
    .ivu-menu-dark.ivu-menu-vertical .ivu-menu-item-active:not(.ivu-menu-submenu), .ivu-menu-dark.ivu-menu-vertical .ivu-menu-item-active:not(.ivu-menu-submenu):hover, .ivu-menu-dark.ivu-menu-vertical .ivu-menu-submenu-title-active:not(.ivu-menu-submenu), .ivu-menu-dark.ivu-menu-vertical .ivu-menu-submenu-title-active:not(.ivu-menu-submenu):hover{
        background-color: rgb(255, 153, 0) !important;
        color: #000!important;
    }

    .ivu-menu-dark.ivu-menu-vertical .ivu-menu-opened .ivu-menu-submenu-title {
        background-color: #121a2a;
    }

    .ivu-menu-dark.ivu-menu-vertical .ivu-menu-item:hover, .ivu-menu-dark.ivu-menu-vertical .ivu-menu-submenu-title:hover {
        background-color: rgb(255, 153, 0) !important;
    }

    .ivu-menu-dark.ivu-menu-vertical .ivu-menu-item-active:not(.ivu-menu-submenu), .ivu-menu-dark.ivu-menu-vertical .ivu-menu-submenu-title-active:not(.ivu-menu-submenu) {
        color: #fff;
    }
</style>

