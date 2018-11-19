import Model from 'flarum/Model';
import mixin from 'flarum/utils/mixin';

export default class Doorkey extends mixin(Model, {
    id: Model.attribute('id'),
    key: Model.attribute('key'),
    groupId: Model.attribute('groupId'),
    maxUses: Model.attribute('maxUses'),
    activates: Model.attribute('activates'),

}) {
    apiEndpoint() {
        return `/reflar/doorkeys${this.exists ? `/${this.data.id}` : ''}`;
    }
}
