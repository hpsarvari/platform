<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Ushahidi Form Contact Validator
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

use Ushahidi\Core\Entity;
use Ushahidi\Core\Entity\FormRepository;
use Ushahidi\Core\Entity\ContactRepository;
use Ushahidi\Core\Tool\Validator;

class Ushahidi_Validator_Form_Contact_Update extends Validator
{
	protected $form_repo;
	protected $contact_repo;
	protected $default_error_source = 'form_contact';

	public function setFormRepo(FormRepository $form_repo)
	{
		$this->form_repo = $form_repo;
	}

	public function setContactRepo(ContactRepository $contact_repo)
	{
		$this->contact_repo = $contact_repo;
	}

	protected function getRules()
	{
		return [
			'form_id' => [
				['digit'],
				[[$this->form_repo, 'exists'], [':value']],
			],
			'contacts' => [
				[[$this->contact_repo, 'idExists'], [':value']],
			],
		];
	}
}