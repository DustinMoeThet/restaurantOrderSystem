$(document).ready(function(){
    $('.btn-plus').click(function(){
     $row = $(this).closest('tr');
     $price = Number($row.find('#productPrice').text());
     $qty = Number($row.find('#qty').val());
     $total = $price * $qty;
     $row.find('#total').text($total);


     $allTotal = Number($('#allTotal').text());
     $allTotal += $price;
     $('#allTotal').text($allTotal);
     finalCalculation()
    })
    $('.btn-minus').click(function(){
     $row = $(this).closest('tr');
     $price = Number($row.find('#productPrice').text());
     $qty = Number($row.find('#qty').val());
     $total = $price * $qty;
     $row.find('#total').text($total);


     $allTotal = Number($('#allTotal').text());
     $allTotal = $allTotal - $price;
     $('#allTotal').text($allTotal);
     finalCalculation();
 })
 $('.btnRemove').click(function(){
     $row = $(this).closest('tr');
     $total= Number($('#total').text());
     $allTotal = Number($('#allTotal').text());
     $allTotal -= $total;
     finalCalculation();
     $('#allTotal').text($allTotal);
     $row.remove();
 })
 function finalCalculation(){
     $finalTotal = Number($('#finalTotal').text());
     $finalTotal = 3000 + $allTotal;
     $('#finalTotal').text($finalTotal);
 }
})
