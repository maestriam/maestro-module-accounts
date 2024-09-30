<x-content-card :title="__('accounts::cards.account-form')" :class="'card-primary mb-0'">    
    <x-row>       
        <!-- account name --> 
        <x-form-group :cols="6">
            <x-input 
                :name="'account'" 
                :model="'account'"
                :live="true"
                :id="'account-input-id'"
                :class="$this->getErrorStyleInput()"
                :label="'Nome da conta'" 
                :readonly="$readOnly" />
                <div class="{{ $this->accountStyle() }}">
                    <i class="fas {{ $this->accountIcon() }}"></i> 
                    {{ $this->accountMessage() }}
                </div>
                <div class="text-danger">
                    {{ $this->getAccountError() }}
                </div>
        </x-form-group>  
        <!-- /account name -->
    </x-row>
</x-card>