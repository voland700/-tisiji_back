@extends('front.layouts.layout')
@section('meta-title', 'TISIJI - Официальный дилер JOTUL в республике Армения, адрес и контакты')
@section('meta-description', 'Контактая информация о компанииTISIJI - представителя JOTUL GROUP в Армении, адрес, телефон, как добраться')
@section('meta-keywords', 'jotul, печи, камины, sacan, дома, дачи, дровяные, отопление, армения, ереван')
@section('h1', "TISIJI - контакты")
@section('breadcrumbs')
    {{ Breadcrumbs::render('front.content.dealer') }}
@endsection
@section('content')
<div class="article-one-wrap">
    <div class="article-content page">
        <p><b>TISIJI</b> - официальный представитель компании производителя печей и каминов JOTUL GROUP в Республика Армения.</p>
        <h3>Реквизиты компании</h3>
        <ul style="margin-bottom: 2rem;">
            <li><strong>ООО  «ТИСИДЖИ АРМ»</strong></li>
            <li>Юридический адрес: <em>Юридический адрес: Республика Армения, г. Ереван, ул. Грачья Кочара, 44/53 </em> </li>
            <li>Код юридического лица: <em>53270739</em></li>
            <li>ИНН: <em>08224523</em></li>
            <li>Тел.: <em>+374(99)885-135</em></li>
        </ul>
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2562.4190604961595!2d44.50873494613748!3d40.203568751701994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abd3812c8c749%3A0x8263865525a717ce!2s44%20Hrachya%20Kochar%20St!5e0!3m2!1sru!2sru!4v1678193711731!5m2!1sru!2sru" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
@endsection
