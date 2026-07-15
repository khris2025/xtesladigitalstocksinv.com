@extends('Userview.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
       <div class="container-fluid">
          <div class="row">
             <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                   <h4 class="mb-sm-0 font-size-18">Manage-Referrals</h4>
                   <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                         <li class="breadcrumb-item active">Manage-Referrals</li>
                      </ol>
                   </div>
                </div>
             </div>
          </div>
          <div class="row">
             <div class="col-xl-6 col-sm-6 ">
                <div class="card card-coin">
                   <div class="card-body text-center">
                      <svg class="mb-3 currency-icon" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <circle cx="40" cy="40" r="40" fill="white"></circle>
                         <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                         <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                         <br>
                      </svg>
                      <span> Referral Bonus Balance </span>
                      <h2 class="text-white mb-2 font-w600">$ {{ number_format(Auth::user()->refbonus) }} 
                        {{-- Modal--}}

                      {{-- <div>
                         <button type="button"  onclick="myFunction()" class="btn light btn-sm btn-rounded btn-warning mt-1"><i class="fa fa-credit-card"></i>Copy Ref Link</button>
                      </div> --}}
                      <script type="text/javascript">
                         function myFunction() {
                         /* Get the text field */
                         var copyText = document.getElementById("myInput");
                         
                         /* Select the text field */
                         copyText.select();
                         copyText.setSelectionRange(0, 99999); /*For mobile devices*/
                         
                         /* Copy the text inside the text field */
                         document.execCommand("copy");
                         
                         /* Alert the copied text */
                         
                         
                         alert("Copied Referral Link: " + copyText.value);
                         }
                         
                         
                         
                         
                      </script>
                      <div class="row">
                        <div class="col-md-8">
                            <input type="text" id="myInput" class="form-control" value="{{ 'https://dashboard.esxcapitalgrowth.com/register' . '?ref=' . Auth::user()->referral_code }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <button type="button" onclick="myFunction()" class="btn light btn-sm btn-primary mt-1">
                                {{-- <i class="fa fa-credit-card"></i>  --}}Copy Ref Link
                            </button>
                        </div>
                    </div>
                    
                     
                   </div>
                </div>
             </div>
             
          </div>
          <div class="row">
             <div class="col-xl-4">
             </div>
             <!-- end col -->
             <div class="col-xl-12">
                <div class="card">
                   <div class="card-header align-items-center d-flex">
                      <h4 class="card-title mb-0 flex-grow-1">Active Referrals</h4>
                      <div class="flex-shrink-0">
                         <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                            <li class="nav-item">
                               <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab" role="tab">
                               Referrals 
                               </a>
                            </li>
                         </ul>
                         <!-- end nav tabs -->
                      </div>
                   </div>
                   <!-- end card header -->
                   <div class="card-body px-0">
                      <div class="tab-content">
                         <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive px-3" data-simplebar >
                               <table id="datatable" class="table nowrap w-100">
                                  <thead>
                                     <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Reg. Date</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($referrals as $referral)
                                       <td style="font-size: 16px;" class="font-w400 ">{{ $referral->fullname }}</td>
                                       <td style="font-size: 16px;" class="font-w400 ">{{ $referral->email }}</td>

                                       <td style="font-size: 16px;" class="font-w400 ">{{ $referral->created_at }}</td>
                                    @endforeach
                                  </tbody>
                               </table>
                            </div>
                         </div>
                         <!-- end tab pane -->
                      </div>
                      <!-- end tab content -->
                   </div>
                   <!-- end card body -->
                </div>
             </div>
             <!-- end col -->
             <!-- end col -->
          </div>
          <!-- end row -->
       </div>
       <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@endsection