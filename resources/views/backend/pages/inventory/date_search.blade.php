   <div class="col-lg-12">
       <div class="white_card card_height_100 mb_30">
           <div class="white_card_body">

               <div class=" mb-0 bg-danger p-2" style="width:150px;display:inline-block">
                   Total Sell : ${{ $product_reports->sum('total_price') }}
               </div>
               <div class=" mb-0 bg-success p-2" style="width:150px;display:inline-block">
                   Total Buy : ${{ $product_reports->sum('buy_total_price') }}
               </div>
               <div class=" mb-0 bg-primary p-2" style="width:150px;display:inline-block">
                   Profit : ${{ $product_reports->sum('total_price') - $product_reports->sum('buy_total_price') }}
               </div>
           </div>
       </div>
   </div>

   <table class="table lms_table_active3 ">
       <thead>
           <tr>
               <th scope="col">Sl No</th>
               <th scope="col">Date</th>
               <th scope="col">Product Name</th>

               <th scope="col">Buy Price</th>
               <th scope="col">sell Price</th>
               <th scope="col">Sell Qty</th>
               <th scope="col">Sell Price Total</th>
               <th scope="col">Buy Price Total</th>


           </tr>
       </thead>

       <tbody id="table_body">
           @foreach ($product_reports as $product)
               <tr>
                   <td>{{ $loop->index + 1 }}</td>
                   <td>{{ $product->created_at->format('Y M d') }}</td>
                   <td><mark>{{ $product->product->name }}</mark></td>

                   <td>${{ $product->product->buy_price }}</td>



                   <td>${{ $product->price }}</td>


                   <td>{{ $product->quentity }}</td>
                   <td>${{ $product->total_price }}</td>
                   <td>${{ $product->buy_total_price }}</td>
               </tr>
           @endforeach
       </tbody>
   </table>
