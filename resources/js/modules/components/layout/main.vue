<template>
    <Layout>
        <Sider ref="sider" hide-trigger collapsible :collapsed-width="78"  v-model="isCollapsed">
            <div class="logo">
                <img src="/vendor/images/logo.png" />
            </div>
            <side-menu :data="data"></side-menu>                
        </Sider>
        <Layout>
            <Header>
                <div class="header-menu">
                    <Icon @click.native="collapsedSider" v-if="isCollapsed"  class="menu-icon rotate-icon" type="md-menu" size="24"></Icon>
                    <Icon @click.native="collapsedSider" v-else class="menu-icon" type="md-menu" size="24"></Icon>
                </div>
                
                <div class="header-sider"><slot name="header"></slot></div>
                
            </Header>
            <div class="layout-router">
                <div class="layout-router-scroll">
                    <Tag type="dot" closable 
                        v-for="(tag, index) in tagLists" :key="index" :color="tag.name === active ? 'warning' : ''"
                        :name="tag.name"
                        @click.native="openTag(tag)"
                        @on-close="closeTag"
                    >{{tag.meta.title}}</Tag>
                </div>
                <div class="layout-router-scroll-dropdown">
                    <Dropdown transfer @on-click="remove">
                        <Button type="warning" size="small">标签管理</Button>
                        <DropdownMenu slot="list">
                            <DropdownItem name="other">关闭其他</DropdownItem>
                            <DropdownItem name="all">关闭全部</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </div>
            <Content>
                <router-view></router-view>
            </Content>
            <Footer><slot name="footer"></slot></Footer>
        </Layout>
    </Layout>
</template>

<script>
    import SideMenu from './components/side-menu/side-menu.vue'
    import { mapGetters } from 'vuex'

    export default {
        name: "i-main",
        components: {SideMenu},
        data(){
            return {
                isCollapsed: false
            }
        },
        computed: {
            ...mapGetters({
                tagLists: 'layout/inactives',
                active: 'layout/active',
                data: 'auth/menus'
            })
        },
        methods: {
            collapsedSider () {
                this.$refs['sider'].toggleCollapse();
            },
            openTag(tag){
                this.$router.push({
                    name: tag.name
                })
            },
            closeTag($event, name){
                this.$store.dispatch('layout/remove', name)
                this.$router.push({
                    name: this.active
                })
            },
            remove(name){
                if(name === 'all'){
                    this.$store.dispatch('layout/removeAll');
                }else{
                    this.$store.dispatch('layout/removeOther');
                } 
                this.$router.push({
                    name: this.active
                })               
            }
        }
    }
</script>

<style scoped lang="less">
.ivu-layout{
    height: 100%;

    .ivu-layout-header{
        background: #fff;
        box-shadow: 0 1px 1px rgba(0,0,0,.1);
        padding: 0 20px;
        display: flex;
        .header-menu{
            .menu-icon{
                cursor: pointer;
                transition: all .3s;
            }

            .rotate-icon{
                transform: rotate(-90deg);
            }
        }

        .header-sider{
            flex: 1;
        }
    }

    .ivu-layout-content{
        position: relative;

        .content-wrapper{
            position: absolute;
            top: 0;
            bottom:0;
            left: 0;
            right: 0;
        }
    }

    .ivu-layout-sider{
        background-color: #000;
        .logo{
            height: 64px;
            line-height: 64px;
            background: #000;
            text-align: center;
            img{
                height: 64px;
            }
        }
        
    }

    .layout-router {
        height: 48px;
        line-height: 46px;
        overflow: hidden;
        background: #fefefe;
        border-top: 1px solid #e8eaec;
        border-bottom: 2px solid #464c5b;
        padding-left: 10px;
        position: relative;
        box-sizing: border-box;
        padding-right: 120px;
        width: 100%;

        .layout-router-scroll-dropdown{
            position: absolute;
            right: 0;
            top: 0;
            box-sizing: border-box;
            text-align: center;
            width: 110px;
            height: 100%;
            background: #fff;
            box-shadow: -3px 0 15px 3px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }
        
        .layout-router-scroll{
            overflow: visible;
            white-space: nowrap;
            transition: left 0.3s ease;
        }
    }
}
</style>