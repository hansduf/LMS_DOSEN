function showMaterialForm() {
    // Hide all other forms first
    hideAssignmentForm();
    hideEditMaterialForm();
    hideEditAssignmentForm();
    
    const materialForm = document.getElementById('materialForm');
    materialForm.classList.remove('hidden');
}

function hideMaterialForm() {
    const materialForm = document.getElementById('materialForm');
    materialForm.classList.add('hidden');
    // Clear form fields
    materialForm.querySelector('form').reset();
}

function showAssignmentForm() {
    // Hide all other forms first
    hideMaterialForm();
    hideEditMaterialForm();
    hideEditAssignmentForm();
    
    const assignmentForm = document.getElementById('assignmentForm');
    assignmentForm.classList.remove('hidden');
}

function hideAssignmentForm() {
    const assignmentForm = document.getElementById('assignmentForm');
    assignmentForm.classList.add('hidden');
    // Clear form fields
    assignmentForm.querySelector('form').reset();
}

function showEditMaterialForm(id, title, description, externalLink) {
    // Hide all other forms first
    hideMaterialForm();
    hideAssignmentForm();
    hideEditAssignmentForm();
    
    const form = document.getElementById('editMaterialForm');
    form.classList.remove('hidden');
    
    // Properly construct the URL by replacing the placeholder
    const url = window.courseData.updateMaterialUrl.replace(':id', id);
    form.querySelector('form').action = url;
    
    const titleInput = form.querySelector('input[name="title"]');
    const descriptionInput = form.querySelector('textarea[name="description"]');
    const externalLinkInput = form.querySelector('input[name="external_link"]');
    
    titleInput.value = title;
    descriptionInput.value = description;
    externalLinkInput.value = externalLink || '';
}

function hideEditMaterialForm() {
    const form = document.getElementById('editMaterialForm');
    form.classList.add('hidden');
    // Clear form fields
    form.querySelector('form').reset();
}

function showEditAssignmentForm(id, title, description, dueDate, attachmentLink) {
    // Hide all other forms first
    hideMaterialForm();
    hideAssignmentForm();
    hideEditMaterialForm();
    
    const form = document.getElementById('editAssignmentForm');
    form.classList.remove('hidden');
    
    // Properly construct the URL by replacing the placeholder
    const url = window.courseData.updateAssignmentUrl.replace(':id', id);
    form.querySelector('form').action = url;
    
    const titleInput = form.querySelector('input[name="title"]');
    const descriptionInput = form.querySelector('textarea[name="description"]');
    const dueDateInput = form.querySelector('input[name="due_date"]');
    const attachmentLinkInput = form.querySelector('input[name="attachment_link"]');
    
    titleInput.value = title;
    descriptionInput.value = description;
    dueDateInput.value = dueDate;
    attachmentLinkInput.value = attachmentLink || '';
}

function hideEditAssignmentForm() {
    const form = document.getElementById('editAssignmentForm');
    form.classList.add('hidden');
    // Clear form fields
    form.querySelector('form').reset();
}

function showAllItems() {
    document.querySelectorAll('.material-item, .assignment-item').forEach(item => {
        item.classList.remove('hidden');
    });
}

// Add click event listener to close forms when clicking outside
document.addEventListener('click', function(event) {
    const materialForm = document.getElementById('materialForm');
    const assignmentForm = document.getElementById('assignmentForm');
    const editMaterialForm = document.getElementById('editMaterialForm');
    const editAssignmentForm = document.getElementById('editAssignmentForm');
    
    // Check if click is outside all forms
    if (!materialForm.contains(event.target) && 
        !assignmentForm.contains(event.target) && 
        !editMaterialForm.contains(event.target) && 
        !editAssignmentForm.contains(event.target) &&
        !event.target.closest('.edit-material-btn') &&
        !event.target.closest('.edit-assignment-btn') &&
        !event.target.closest('#showMaterialBtn') &&
        !event.target.closest('#showAssignmentBtn')) {
        
        hideMaterialForm();
        hideAssignmentForm();
        hideEditMaterialForm();
        hideEditAssignmentForm();
    }
});

// Add event listeners for edit buttons
document.addEventListener('DOMContentLoaded', function() {
    // Initialize course data
    window.courseData = {
        id: document.querySelector('meta[name="course-id"]')?.content,
        updateMaterialUrl: document.querySelector('meta[name="update-material-url"]')?.content,
        updateAssignmentUrl: document.querySelector('meta[name="update-assignment-url"]')?.content
    };

    // Add event listeners for edit material buttons
    document.querySelectorAll('.edit-material-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const description = this.dataset.description;
            const externalLink = this.dataset.externalLink;
            showEditMaterialForm(id, title, description, externalLink);
        });
    });

    // Add event listeners for edit assignment buttons
    document.querySelectorAll('.edit-assignment-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const description = this.dataset.description;
            const dueDate = this.dataset.dueDate;
            const attachmentLink = this.dataset.attachmentLink;
            showEditAssignmentForm(id, title, description, dueDate, attachmentLink);
        });
    });

    // Add event listeners for delete buttons
    document.querySelectorAll('.delete-material-btn, .delete-assignment-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });
}); 