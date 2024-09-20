


   

    <div class="modal fade export-pdf" id="barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ __('table.count_barcodes') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_export-pdf">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{-- <form action="{{ route('backend.qr_code_generate',$row_1) }}" method="post" > --}}
                <form action="" method="post" id="form_barcode">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label for="name"> {{ __('table.Count') }}</label>
                    <input type="number" class="form-control "
                        placeholder="{{ __('table.count') }}" name="count"
                        value="1" />
                 
    
                </div>
    
                <div class="modal-footer">
            
                    <button type="submit" class="btn btn-primary">{{ __('table.Submit') }}</button>
                  </div>
    
            </form>
            </div>
           
          </div>
        </div>
      </div>