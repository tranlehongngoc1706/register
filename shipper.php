<body>
<form action='' method='post'>
    <table class="orders">
        <thead>
            <tr>
                <th>ID</th>
                <th>Products</th>
                <th> Status <input type="hidden" name='status[]' value="status"> </th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach ($featuredProducts as $featuredProduct) {
                    $id = $featuredProduct['id'];
                    $products = $featuredProduct['products'];
                    $status = $featuredProduct['status'];
                    if($status == "Active") {
                    echo "
                        <tr>
                            <td>$id</td>
                            <td>$products</td>
                            <td><select name='status[]' class='status'>
                                <option value='Active' selected='selected'>Active</option>
                                <option value='Ordered'>Ordered</option>
                                <option value='Delivered'>Delivered</option>
                            </select>
                            </td>
                        </tr>           
                        ";
                        $featuredProductsCount++;
                        if ($featuredProductsCount == 15) {
                            break;
                        }         
                    }
                }
            ?>
            <tr>
                <td> </td>
                <td> </td>
                <td> <button class="form_button" type="submit" name="submit"> Submit</button> <td>
            </tr>
        </tbody>   
    </table>
</form>
