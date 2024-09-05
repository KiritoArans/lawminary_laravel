<table class="table table-striped table-bordered">
    
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Account Type</th>
            <th>Sex</th>
            <th>Restrict</th>
            <th>Restrict Day(s)</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="accountTableBody">
        @foreach($accounts as $account)
        <tr>
            <td>{{ $account->id }}</td>
            <td>{{ $account->username }}</td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->accountType }}</td>
            <td>{{ $account->sex }}</td>
            <td>{{ $account->restrict }}</td>
            <td>{{ $account->restrictDays }}</td>
            <td>{{ $account->created_at }}</td>
            <td>
                
            <!--view/edit button-->
            <button type="button" class="custom-button edit-button"
            data-id="{{$account->id}}"
            data-user_id="{{$account->user_id}}"
            data-username="{{$account->username}}"
            data-email="{{$account->email}}"
            data-firstName="{{$account->firstName}}"
            data-middleName="{{$account->middleName}}"
            data-lastName="{{$account->lastName}}"
            data-birthDate="{{$account->birthDate}}"
            data-nationality="{{$account->nationality}}"
            data-sex="{{$account->sex}}"
            data-contactNumber="{{$account->contactNumber}}"
            data-restrict="{{$account->restrict}}"
            data-restrictDays="{{$account->restrictDays}}"
            data-accountType="{{$account->accountType}}"
            >
                Edit
            </button>

            <!-- Modal Structure (Only one modal for all accounts) -->
            <div id="editAccountModal" class="modal">
                <div class="modal-content">
                    <span class="close-button" id="closeEditModalX">&times;</span>
                    <h2>Edit Account</h2>
                  
                    @include('includes_accounts.edit_inc')
                </div>
            </div>
            
                <!--delete button-->
                @include('includes_accounts.delete_inc')                                                                             
            </td>
        </tr>
        @endforeach
    </tbody>
</table>