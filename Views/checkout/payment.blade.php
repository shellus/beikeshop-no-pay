
<div>
  <div class="text-center my-2 fs-4">
    请等待页面跳转。。。
  </div>
</div>

<script type="text/javascript">

  var timer

  function chekOrderStatus() {
    $http.post('{{ shop_route('no_pay.order_status', ['number' => $order['number']]) }}', null, {hload: true}).then((res) => {
      if (res.data.status == 'paid') {
        window.clearInterval(timer)
        layer.msg('{{ __('admin/marketing.pay_success_title') }}');
        window.location.href = '{{ shop_route('account.order.show', ['number' => $order['number']]) }}'
      }
    })
  }

  setTimeout(()=>{
    timer = window.setInterval(() => {
      chekOrderStatus()
    }, 1000)
  }, 2000);

</script>
