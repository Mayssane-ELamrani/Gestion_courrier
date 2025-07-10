<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourrierDepartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      
        return [
            'reference' => 'required|string|max:255|unique:courrier_departs,reference',
            'date_envoi' => 'required|date',
            'destinataire' => 'required|string|max:255',
            'source_type' => 'required|in:agent,departement',
            'agent_nom' => 'required_if:source_type,agent|nullable|string|max:255',
            'departement_source_id' => [
                'nullable',
                Rule::requiredIf($this->source_type === 'departement'),
                'exists:departements,id'
            ],
            'objet_id' => 'nullable|exists:objets,id',
            'etat_id' => 'required|exists:etats,id',
            'description_objet' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'reference.required' => 'La référence est obligatoire.',
            'reference.unique' => 'Cette référence existe déjà.',
            'date_envoi.required' => 'La date d\'envoi est obligatoire.',
            'date_envoi.date' => 'La date d\'envoi doit être une date valide.',
            'destinataire.required' => 'Le destinataire est obligatoire.',
            'destinataire.max' => 'Le destinataire ne peut pas dépasser 255 caractères.',
            'source_type.required' => 'Le type de source est obligatoire.',
            'source_type.in' => 'Le type de source doit être soit "agent" soit "departement".',
            'agent_nom.required_if' => 'Le nom de l\'agent est obligatoire quand la source est "agent".',
            'agent_nom.max' => 'Le nom de l\'agent ne peut pas dépasser 255 caractères.',
            'departement_source_id.required_if' => 'Le département est obligatoire quand la source est "departement".',
            'departement_source_id.exists' => 'Le département sélectionné n\'existe pas.',
            'objet_id.exists' => 'L\'objet sélectionné n\'existe pas.',
            'etat_id.required' => 'L\'état est obligatoire.',
            'etat_id.exists' => 'L\'état sélectionné n\'existe pas.',
            'description_objet.max' => 'La description ne peut pas dépasser 1000 caractères.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'reference' => 'référence',
            'date_envoi' => 'date d\'envoi',
            'destinataire' => 'destinataire',
            'source_type' => 'type de source',
            'agent_nom' => 'nom de l\'agent',
            'departement_source_id' => 'département',
            'objet_id' => 'objet',
            'etat_id' => 'état',
            'description_objet' => 'description de l\'objet',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Additional custom validation logic if needed
            if ($this->source_type === 'agent' && empty($this->agent_nom)) {
                $validator->errors()->add('agent_nom', 'Le nom de l\'agent est requis.');
            }
            
            if ($this->source_type === 'departement' && empty($this->departement_source_id)) {
                $validator->errors()->add('departement_source_id', 'Le département est requis.');
            }
        });
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Log validation errors for debugging
        \Log::error('Validation failed for StoreCourrierDepartRequest:', [
            'errors' => $validator->errors()->toArray(),
            'input' => $this->all()
        ]);

        parent::failedValidation($validator);
    }
}