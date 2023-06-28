<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Filter
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter ads</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/" method="get">
            <label for="category">Category</label>
            <select name="category" class="form-control">
            @foreach ($category as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>                
            @endforeach    
            </select><br>
            <label for="price_of">Price of:</label>
            <input type="number" name="priceOf"class="form-control" placeholder="Price of"><br>

            <label for="price_to">To:</label>
            <input type="number" name="priceTo"class="form-control" placeholder="Price to"><br>
          <button type="submit" class="btn btn-primary">Search</button>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>