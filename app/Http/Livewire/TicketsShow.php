<?php

namespace App\Http\Livewire;

use App\Models\Note;
use Livewire\Component;

class TicketsShow extends Component {

	public $ticket;
	public $project;
	public $notes;
	public $active_menu;
	public $content;

	public function mount($ticket)
	{
		$this->ticket = $ticket;
		$this->active_menu = 'ticket-information';
	}

	public function render()
	{
		$this->notes = Note::where('ticket_id', $this->ticket->id)->orderBy('submitted_at')->get();

		return view('livewire.tickets-show');
	}

	public function changeActiveMenu($menu)
	{
		$this->active_menu = $menu;
	}

	public function storeNote()
	{
		if ($this->content) {
			$user = auth()->user();

			$new_note = new Note();
			$new_note->ticket_id = $this->ticket->id;
			$new_note->user_id = $user->id;
			$new_note->content = $this->content;
			$new_note->is_reporter = ($this->ticket->reported_by_user_id == $user->id) ? 1 : 0;
			$new_note->is_assigned = ($this->ticket->assigned_to_user_id == $user->id) ? 1 : 0;
			$new_note->is_supervisor = (in_array($user->id, $this->ticket->project->projectUsers->where('is_supervisor', 1)->pluck('user_id')->toArray())) ? 1 : 0;
			$new_note->submitted_at = now();
			$new_note->save();

			$this->content = '';

			$this->dispatchBrowserEvent('noteSubmitted');

		} else {
			$this->dispatchBrowserEvent('missingNote');
		}
	}

	public function deleteNote($note)
	{
		Note::destroy($note);
	}

}
