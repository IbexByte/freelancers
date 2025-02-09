<div>
    <div class="profile-form">
        <div class="form-group">
            <label for="services">الخدمات التي تقدمها</label>
            <input 
                type="text" 
                id="services"
                wire:model.defer="services"
                placeholder="مثال: تطوير ويب، تصميم، كتابة محتوى..."
            >
        </div>
        <div class="form-group">
            <label for="rates">أسعارك</label>
            <input 
                type="text" 
                id="rates"
                wire:model.defer="rates"
                placeholder="مثال: 50$ للساعة"
            >
        </div>
        <div class="form-group">
            <label for="portfolioLink">رابط معرض الأعمال</label>
            <input 
                type="text" 
                id="portfolioLink"
                wire:model.defer="portfolioLink"
            >
        </div>

        <button class="btn-save" wire:click="updateSettings">
            حفظ الإعدادات
        </button>
    </div>
</div>
