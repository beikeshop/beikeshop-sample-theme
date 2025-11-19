/*
 * @copyright     2022 beikeshop.com - All Rights Reserved.
 * @link          https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @Date          2022-08-29 17:32:51
 * @LastEditTime  2023-12-22 11:41:59
 */

import http from "../../../../../../../resources/js/http.js";
import common from "./common";
window.bk = common;
window.$http = http;

const token = document.querySelector('meta[name="csrf-token"]').content;
const base = document.querySelector('base').href;

import './product';
import './header'
import './footer'
import './bootstrap-validation'

$(document).ready(function ($) {
  if ($(window).width() > 992 && $('.x-fixed-top').length) {
    $('.x-fixed-top').scrollToFixed({
      zIndex: 99,
      marginTop: $('.menu-box').outerHeight(true) || 0,
      limit: function () {
        var limit = $('footer').offset().top - 84 - $('.x-fixed-top').outerHeight(true);
        return limit
      }
    });
  }

  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

  bk.productImageResize()
  window.addEventListener('resize', function () {
    bk.productImageResize()
  })
});

bk.getCarts(); // 页面初始加载购物车数据