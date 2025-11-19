@if (version_compare(config('beike.version'), '2.0') < 0)
<style>
  .quantity-wrap {
    align-content: space-between;
    border: 1px solid #ced4da;
    display: flex;
    height: 37px;
    width: 80px
  }

  @media (max-width:768px) {
    .quantity-wrap {
      flex: 0 0 60px;
      width: 60px
    }
  }

  .quantity-wrap input {
    border: none;
    padding: .5rem
  }

  .quantity-wrap>.right {
    border-left: 1px solid #ced4da;
    display: flex;
    flex-direction: column
  }

  .quantity-wrap>.right i {
    background-color: #fff;
    cursor: pointer;
    flex: 1;
    height: 17px;
    text-align: center;
    width: 20px
  }

  .quantity-wrap>.right i:last-of-type {
    border-top: 1px solid #ced4da
  }

  .quantity-wrap>.right i:hover {
    background-color: #eee
  }
</style>

<script>
  $(document).on('click', '.quantity-wrap .right i, .quantity-wrap-line .right i', function(event) {
  event.stopPropagation();
  event.preventDefault();

  let input = $(this).parent().siblings('input')

  if ($(this).hasClass('bi-chevron-up')) {
    input.val(input.val() * 1 + 1)
    input.get(0).dispatchEvent(new Event('input'));
    return;
  }

  if (input.val() * 1 <= input.attr('minimum') * 1) {
    return;
  }

  if (input.val () * 1 <= 1) {
    return;
  }

  input.val(input.val() * 1 - 1)
  input.get(0).dispatchEvent(new Event('input'));
});
</script>
@endif

@if (version_compare(config('beike.version'), '2.0') >= 0)
<style>
  .modules-box .module-item.module-item-design:not(.currently-editing):hover:after {
    display: block;
    outline: 1px dashed #0072ff;
  }
</style>
<style>
  #offcanvas-search-top {
    height: 100vh;
    justify-content: center;
    display: block;
  }
  @media (min-width: 992px) {
    #offcanvas-search-top {
      height: 520px;
    }
  }
  @media (min-width: 1200px) {
    #offcanvas-search-top {
      height: 560px;
    }
  }
  @media (min-width: 1400px) {
    #offcanvas-search-top {
      height: 600px;
    }
  }
  @media (max-width: 992px) {
    #offcanvas-search-top {
      overflow-y: auto;
      padding-bottom: 40px;
    }
  }
  @media (max-width: 768px) {
    #offcanvas-search-top.offcanvas-start {
      width: 100%;
    }
  }
  #offcanvas-search-top .offcanvas-header {
    width: 100%;
    padding-left: 0;
    padding-right: 0;
  }
  #offcanvas-search-top .search-input-wrap {
    position: relative;
    margin-right: 6px;
    margin-bottom: 10px;
  }
  #offcanvas-search-top .search-input-wrap input {
    border-color: #222;
    border-radius: 100px;
  }
  #offcanvas-search-top .search-input-wrap input:focus {
    box-shadow: none;
    border-color: #333;
  }
  #offcanvas-search-top .search-input-wrap .input-group-text {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    color: #222;
    border: none;
    font-size: 17px;
    width: 50px;
    text-align: center;
    background-color: transparent;
    z-index: 9;
  }
  #offcanvas-search-top .btn-close {
    padding: 1rem;
    opacity: 1;
  }
  #offcanvas-search-top .btn-close:hover {
    background-color: #eee;
  }
  #offcanvas-search-top .hot-search-wrap .hot-search-list {
    list-style: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }
  #offcanvas-search-top .search-pop-products-wrap .spinner-border {
    display: none;
  }
  #offcanvas-search-top .search-pop-products-wrap.loading {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 300px;
    background-color: #f5f5f5;
  }
  #offcanvas-search-top .search-pop-products-wrap.loading .sp-products, #offcanvas-search-top .search-pop-products-wrap.loading .hot-products-title {
    display: none;
  }
  #offcanvas-search-top .search-pop-products-wrap.loading .spinner-border {
    display: block;
  }
  #offcanvas-search-top .search-pop-products-show-all .btn {
    border-radius: 60px;
    background-color: #222;
    color: #fff;
    min-width: 120px;
  }
</style>
@endif