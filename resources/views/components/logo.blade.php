<div class="logo-container">
  <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" alt="Logo CMSS" class="logo" />
</div>

@push('styles')
<style>
  .logo-container {
    position: relative;
  }
  .logo {
    position: absolute;
    top: 20px;
    right: 30px;
    width: 100px;
    height: 100px;
    object-fit: contain;
  }
</style>
@endpush
