@extends('core::admin.master')

@section('title', __('Contacts'))

@section('content')

<item-list
    url-base="/api/contacts"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,created_at,title,phone,email,subject,message"
    table="contacts"
    title="contacts"
    :multilingual="false"
    :publishable="false"
    :exportable="false"
    :searchable="['name,email,message']"
    :sorting="['-created_at']">



    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update contacts')||$can('delete contacts')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update contacts')"></item-list-column-header>
        <item-list-column-header name="created_at" sortable :sort-array="sortArray" :label="$t('Date')"></item-list-column-header>
        <item-list-column-header name="title" sortable :sort-array="sortArray" :label="$t('姓名')"></item-list-column-header>
        <item-list-column-header name="phone" sortable :sort-array="sortArray" :label="$t('Phone')"></item-list-column-header>
        <item-list-column-header name="email" sortable :sort-array="sortArray" :label="$t('email')"></item-list-column-header>
        <item-list-column-header name="message" sortable :sort-array="sortArray" :label="$t('Message')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update contacts')||$can('delete contacts')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td v-if="$can('update contacts')">@include('core::admin._button-edit', ['module' => 'contacts'])</td>
        <td>@{{ getDate(model.created_at) }}</td>
        <td>@{{ model.title }}</td>
        <td>@{{ model.phone }}</td>
        <td><a :href="'mailto:'+model.email">@{{ model.email }}</a></td>
        <td>@{{ model.message }}</td>
    </template>

</item-list>

@endsection
