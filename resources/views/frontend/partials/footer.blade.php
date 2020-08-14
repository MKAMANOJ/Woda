<footer id="footer-section">
  <div class="my-footer">
    <div class="row">
      <div class="col-md-3 col-xs-12 privacy">
        <div class="logofooter">
          <img class="pull-left" height="90 " width="105" src="{{ asset('web-template/images/logo.png') }}">
        </div>
        <h4 style="color: white">
          @lang('data.org_name')
        </h4><br><br>
        <p>
          <i class="fa fa-map-pin"></i> 
          @lang('data.org_place')
        </p>
        <p>
          <i class="fa fa-phone"></i> @lang('data.telephone') :
            @if(session()->get('checkLanguages') == 'en')
              {{ $contactUs->phone1 }} @isset($contactUs->phone2), {{ $contactUs->phone2 }} @endisset
            @else
              {{ $contactUs->nepali_phone1 }} @isset($contactUs->nepali_phone2), {{ $contactUs->nepali_phone2 }} @endisset
            @endif
        </p>
        @isset($contactUs->fax) 
          <p>
            <i class="fa fa-fax"></i> @lang('data.fax') :
            @if(session()->get('checkLanguages') == 'en')
              {{ $contactUs->fax }}
            @else
              {{ $contactUs->nepali_fax }}
            @endif
          </p> 
        @endisset
        @isset($contactUs->email) 
          <p>
            <i class="fa fa-envelope"></i> @lang('data.email') : {{ $contactUs->email }}
          </p> 
        @endisset
      </div>

      <div class="col-md-6 col-xs-12 privacy">
        <h3 style="color: white">@lang('data.important_numbers')</h3><br>
        <div class="table-resposive phonetable">
          <table class="table table">
            <thead>
              <tr>
                <th style="color: white">#</th>
                @if(session()->get('checkLanguages') == 'en')
                  <th style="color: white">Name</th>
                  <th style="color: white">Phone Number</th>
                @else
                  <th style="color: white">नाम</th>
                  <th style="color: white">फोन नम्बर</th>  
                @endif
              </tr>
              </thead>
              <tbody>
                @forelse($phoneNumbers as $phoneNumber)
                  <tr>
                      <td style="color: white">{{ $loop->iteration }}</td>
                      @if(session()->get('checkLanguages') == 'en')
                        <td style="color: white">{{ $phoneNumber->name }}</td>
                        <td style="color: white">{{ $phoneNumber->phone_number }}</td>
                      @else
                        <td style="color: white">{{ $phoneNumber->nepali_name }}</td>
                        <td style="color: white">{{ $phoneNumber->nepali_phone_number }}</td>
                      @endif
                  </tr>
                @empty
                  <tr>
                    <td>No Phone Numbers</td>
                  </tr>
                @endforelse
              </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-3 col-xs-12 privacy">
        <h3 style="color: white">@lang('data.important_links')</h3><br>
        <ul class="footer-ul">
          @forelse($websiteLinks as $websiteLink)
            <li>
              <a href="https://nepal.gov.np/" target="_blank"> 
                @if(session()->get('checkLanguages') == 'en')
                  {{ $websiteLink->name }}
                @else
                  {{ $websiteLink->nepali_name }}
                @endif
              </a>
            </li>
          @empty
            <span>No Website Links</span>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
  <div class="copyright">
      <p>© {{ date('Y') }} @lang('data.org_name')</p>
  </div>
</footer>