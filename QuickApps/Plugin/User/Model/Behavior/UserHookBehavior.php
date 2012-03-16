<?php
/**
 * User Model Hooks
 *
 * PHP version 5
 *
 * @package  QuickApps.Plugin.User.Model.Behavior
 * @version  1.0
 * @author   Christopher Castro <chris@qucikapps.es>
 * @link     http://cms.quickapps.es
 */
class UserHookBehavior extends ModelBehavior {
/**
 * Prevent unnecessary variables to load on startup by
 * QuickAppsComponent::loadVariables()
 *
 * @param Model $Model Model object
 * @param array $query Query parameters as set by cake
 * @return array Modified query array
 * @see QuickAppsComponent::loadVariables()
 */
    public function beforeFind($Model, $query) {
        if ($Model->name == 'Variable' && empty($query['conditions'])) {
            $query['conditions'] = Set::merge($query['conditions'],
                array(
                    'NOT' => array(
                        'Variable.name LIKE' => "user_mail_%"
                    )
                )
            );
        }

        return $query;
    }
}