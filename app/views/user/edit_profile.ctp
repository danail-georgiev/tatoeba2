<?php
/**
 * Tatoeba Project, free collaborative creation of multilingual corpuses project
 * Copyright (C) 2011  HO Ngoc Phuong Trang <tranglich@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Tatoeba
 * @author   HO Ngoc Phuong Trang <tranglich@gmail.com>
 * @license  Affero General Public License
 * @link     http://tatoeba.org
 */
?>
<div id="annexe_content">
    <?php
        echo $this->element(
        'users_menu', 
        array('username' => CurrentUser::get('username'))
    );
    ?>
</div>

<div id="main_content">
    <div class="module">
    <h2><?php __('Profile - Picture'); ?></h2>
    <div class="currentPicture">
        <div class="title"><?php __('Current picture'); ?></div>
        <?php
        $image = 'unknown-avatar.png';
        if (!empty($this->data['User']['image'])) {
            $image = $this->data['User']['image'];
        }
        echo $html->image(
            IMG_PATH . 'profiles_128/'.$image
        );
        ?>
    </div>
    
    <div class="newPicture">
        <div class="title"><?php __('New picture'); ?></div>
        <?php
        echo $form->create(
            'profile_image',
            array(
                'url' => array(
                    'controller' => 'user',
                    'action' => 'save_image'
                ),
                'type' => 'file'
            )
        );
        echo $form->file('image');
        echo $form->end(__('Upload', true));
        ?>
    </div>
    
    </div>
    
    <div class="module">
    <h2><?php __('Profile - Personal information'); ?></h2>
    <?php 
    $dateOptions = array(
        'minYear' => date('Y') - 100,
        'maxYear' => date('Y') - 3,
        'type' => 'date',
        'selected' => $this->data['User']['birthday'],
        'empty' => true,
        'label' => __('Birthday', true)
    );
    $selectedCountryId = $this->data['Country']['id'];
    
    echo $form->create(
        null, 
        array(
            'controller' => 'user',
            'action' => 'save_basic'
        )
    );
    
    echo $form->input(
        'name', 
        array('label' => __('Name', true))
    );
    
    echo '<div class="input">';
    echo '<label for="UserCountryId">';
    __('Country');
    echo '</label>';
    echo $form->select(
        'country_id', 
        $countries, 
        $selectedCountryId
    );
    echo '</div>';
    
    echo $form->input(
        'birthday', 
        $dateOptions
    );
    
    echo $form->input(
        'homepage',
        array('label' => __('Homepage', true))
    );
    echo $form->end(__('Save personal information', true));
    ?>
    </div>
    
    
    <div id="description" class="module">
    <h2><?php __('Profile - Description'); ?></h2>
    <?php 
    echo $form->create(
        null, 
        array(
            'controller' => 'user',
            'action' => 'save_description'
        )
    );
    echo $form->textarea('description');
    echo $form->end(__('Save description', true)); 
    ?>
    </div>
</div>