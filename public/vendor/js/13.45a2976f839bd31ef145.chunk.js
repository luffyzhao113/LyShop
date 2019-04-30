(window.webpackJsonp=window.webpackJsonp||[]).push([[13],{"3Q9P":function(r,e,t){"use strict";e.a={methods:{validate:function(r){var e=this;return new Promise(function(t,a){e.$refs[r].validate(function(r){r?t():a()})})}}}},D1eL:function(r,e,t){"use strict";var a=t("rgQu");t.n(a).a},V4Wm:function(r,e,t){"use strict";t.r(e);var a={name:"index",mixins:[t("3Q9P").a],data:function(){var r=this;return{profile:{},loading:!0,ruleValidate:{phone:[{required:!0,message:"手机号码必须填写",trigger:"blur"},{pattern:/^1[34578]\d{9}$/,message:"手机号码格式不正确",trigger:"blur"}],password_original:[{required:!0,message:"用户密码不能为空",trigger:"blur"},{type:"string",min:6,max:20,message:"用户密码字符长度是6-20个字符",trigger:"blur"}],password:[{validator:function(e,t,a){return void 0===t||""===t?a():t.length<6||t.length>20?a("用户密码字符长度是6-20个字符"):t===r.profile.password_original?a("修改后的密码不能和原始密码一样"):void 0},message:"用户密码不能为空",trigger:"blur"}],status:[{required:!0,type:"enum",enum:["off","on"],message:"用户状态不能为空"}],sex:[{required:!0,type:"enum",enum:["women","man"],message:"性别状态不能为空"}],password_confirmation:[{trigger:"blur",validator:function(e,t,a){return t===r.profile.password?a():a("二次输入密码不正确")}}]}}},mounted:function(){var r=this;this.$http.get("profile").then(function(e){r.profile=e}).finally(function(){r.loading=!1})},methods:{submit:function(r){var e=this;this.validate(r).then(function(){e.$http.put("profile",e.profile).then(function(r){}).finally(function(){e.loading=!1})}).catch(function(){})}}},o=(t("D1eL"),t("KHd+")),i=Object(o.a)(a,function(){var r=this,e=this,t=e.$createElement,a=e._self._c||t;return a("Row",{staticClass:"content-wrapper"},[a("Col",{staticClass:"profile-card-list",attrs:{md:10,lg:8,xl:6}},[a("Card",{staticClass:"profile-detail-card",attrs:{padding:0,"dis-hover":!0,shadow:!0}},[a("div",{staticClass:"profile-detail"},[a("div",{staticClass:"profile-info"},[a("div",{staticClass:"profile-info-list"},[a("p",[e._v("姓名: "+e._s(e.profile.name))]),e._v(" "),a("div",{staticClass:"profile-role"},[a("Tag",{attrs:{color:"warning"}},[e._v(e._s(e.profile.role?e.profile.role.name:""))])],1),e._v(" "),a("p",[e._v("邮箱: "+e._s(e.profile.email))]),e._v(" "),a("p",[e._v("手机号码: "+e._s(e.profile.phone))]),e._v(" "),a("p",[e._v("性别:\n                            "),"man"===e.profile.sex?a("Icon",{attrs:{type:"md-male",color:"#2d8cf0"}}):e._e(),e._v(" "),"women"===e.profile.sex?a("Icon",{attrs:{type:"md-female",color:"#ed4014"}}):e._e()],1),e._v(" "),a("p",[e._v("生日: "+e._s(e.profile.birthday))]),e._v(" "),a("p",[e._v("入职时间: "+e._s(e.profile.entryday))])])])])])],1),e._v(" "),a("Col",{staticClass:"profile-card-list",attrs:{md:14,lg:16,xl:18}},[a("Card",{staticClass:"profile-edit-card",attrs:{"dis-hover":!0,shadow:!0}},[a("Form",{ref:"formProfile",attrs:{model:e.profile,"label-width":100,rules:e.ruleValidate}},[a("FormItem",{attrs:{label:"手机号码",prop:"phone"}},[a("Input",{attrs:{placeholder:"手机号码"},model:{value:e.profile.phone,callback:function(r){e.$set(e.profile,"phone",r)},expression:"profile.phone"}})],1),e._v(" "),a("Row",{staticClass:"ivu-form-item-row"},[a("Col",{attrs:{span:"12"}},[a("FormItem",{attrs:{label:"生日",prop:"birthday"},on:{"on-form-change":function(e){return r.profile.birthday=e}}},[a("DatePicker",{attrs:{placeholder:"生日",format:"yyyy-MM-dd"},on:{"on-change":function(e){return r.profile.birthday=e}},model:{value:e.profile.birthday,callback:function(r){e.$set(e.profile,"birthday",r)},expression:"profile.birthday"}})],1)],1),e._v(" "),a("Col",{attrs:{span:"12"}},[a("FormItem",{attrs:{label:"性别",prop:"sex"}},[a("i-switch",{attrs:{"true-value":"man","false-value":"women"},model:{value:e.profile.sex,callback:function(r){e.$set(e.profile,"sex",r)},expression:"profile.sex"}},[a("span",{attrs:{slot:"open"},slot:"open"},[e._v("男")]),e._v(" "),a("span",{attrs:{slot:"close"},slot:"close"},[e._v("女")])])],1)],1)],1),e._v(" "),a("FormItem",[a("Alert",{staticClass:"form-alert",attrs:{"show-icon":"",type:"error"}},[e._v("如果不需要修改密码，下面可以不填。")])],1),e._v(" "),a("FormItem",{attrs:{label:"用户密码",prop:"password_original"}},[a("Input",{attrs:{placeholder:"请输入用户密码"},model:{value:e.profile.password_original,callback:function(r){e.$set(e.profile,"password_original",r)},expression:"profile.password_original"}})],1),e._v(" "),a("FormItem",{attrs:{label:"修改后的密码",prop:"password"}},[a("Input",{attrs:{placeholder:"请输入修改后密码"},model:{value:e.profile.password,callback:function(r){e.$set(e.profile,"password",r)},expression:"profile.password"}})],1),e._v(" "),a("FormItem",{attrs:{label:"确认修改后的密码",prop:"password_confirmation"}},[a("Input",{attrs:{placeholder:"请输入确认密码"},model:{value:e.profile.password_confirmation,callback:function(r){e.$set(e.profile,"password_confirmation",r)},expression:"profile.password_confirmation"}})],1),e._v(" "),a("FormItem",[a("Button",{attrs:{type:"primary"},on:{click:function(r){return e.submit("formProfile")}}},[e._v("保存")])],1)],1)],1)],1),e._v(" "),e.loading?a("Spin",{attrs:{size:"large",fix:""}}):e._e()],1)},[],!1,null,"1150a0b1",null);e.default=i.exports},YsB0:function(r,e,t){(r.exports=t("I1BE")(!1)).push([r.i,".content-wrapper[data-v-1150a0b1]{padding:18px;overflow:auto}.content-wrapper .profile-card-list[data-v-1150a0b1]{padding:0 10px}.content-wrapper .profile-card-list .profile-edit-card .form-alert[data-v-1150a0b1]{margin-bottom:0px}.content-wrapper .profile-card-list .profile-edit-card .ivu-form-item-row[data-v-1150a0b1]{margin-bottom:24px}.content-wrapper .profile-card-list .profile-edit-card .ivu-form-item[data-v-1150a0b1]:last-child{margin-bottom:0px}.content-wrapper .profile-card-list .profile-detail-card[data-v-1150a0b1]{margin-bottom:10px}.content-wrapper .profile-card-list .profile-detail-card .profile-detail[data-v-1150a0b1]{position:relative;padding:16px}.content-wrapper .profile-card-list .profile-detail-card .profile-detail .profile-avatar[data-v-1150a0b1]{height:165px;position:relative}.content-wrapper .profile-card-list .profile-detail-card .profile-detail .profile-avatar .profile-avatar-img[data-v-1150a0b1],.content-wrapper .profile-card-list .profile-detail-card .profile-detail .profile-avatar .profile-avatar-upload[data-v-1150a0b1]{height:150px;width:150px;border-radius:50%;position:absolute;left:50%;margin-left:-75px;top:0;cursor:pointer}.content-wrapper .profile-card-list .profile-detail-card .profile-detail .profile-avatar .profile-avatar-upload[data-v-1150a0b1]{z-index:2}.content-wrapper .profile-card-list .profile-detail-card .profile-detail .profile-info[data-v-1150a0b1]{text-align:center}.content-wrapper .profile-card-list .profile-detail-card .profile-detail .profile-info .profile-info-list[data-v-1150a0b1]{line-height:28px}",""])},rgQu:function(r,e,t){var a=t("YsB0");"string"==typeof a&&(a=[[r.i,a,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};t("aET+")(a,o);a.locals&&(r.exports=a.locals)}}]);