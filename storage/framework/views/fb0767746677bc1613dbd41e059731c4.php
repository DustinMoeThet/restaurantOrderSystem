<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
User Home Page

Role-<?php echo e(Auth::user()->role); ?>


<form action="<?php echo e(route('logout')); ?>" method="post">

<?php echo csrf_field(); ?>
<input type="submit" value="Logout">

</form>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/user/home.blade.php ENDPATH**/ ?>