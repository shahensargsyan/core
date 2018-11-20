<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Тег FORM</title>
 </head>
 <body>
    <h3>filterProducts: </h3>
    <form action="/api/filterProducts" method="POST" target="_blank">
        <label>fuel_type_id: </label>
        <input type="text" name="fuel_type_id" placeholder="fuel_type_id" value="[2]" />
        <label>fireplace_type_id: </label>
        <input type="text" name="fireplace_type_id" placeholder="fireplace_type_id" value="[3]" />
        <label>fireplace_size_range_id: </label>
        <input type="text" name="fireplace_size_range_id" placeholder="fireplace_size_range_id" value="[3]" />
        <label>heat_output_range_id: </label>
        <input type="text" name="heat_output_range_id" placeholder="heat_output_range_id" value="[3]" />
        <label>price_range_id: </label>
        <input type="text" name="price_range_id" placeholder="price_range_id" value="[2]" />
        
        <input type="submit" value="Send" />
    </form>
    <br /><br />
    <h3>getProductDetails: </h3>
    <form action="/api/getProductDetails" method="POST" target="_blank">
        <label>product_id: </label>
        <input type="text" name="product_id" placeholder="product_id" value="4" />
        <input type="submit" value="Send" />
    </form>
    <br /><br />
    
</body>
</html>