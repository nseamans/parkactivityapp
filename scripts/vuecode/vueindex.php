<script>
    let app = new Vue({
        el: '#choices',
        data: {
            activities: [],
            activitiesList: ''
        },
        methods: {
            /* remove
            * Removes an activity from the activities array. The activity is then 
            * added to the activities list string. THis is done to get results from
            * JavaScript to play with php nicely.
            */
            remove: function(id) {
                for (i = 0; i < this.activities.length; i++) {
                    if (String(this.activities[i].id) === String(id)) {
                        let activitiesName = [];
                        if (i === 0) {
                            this.activities.splice(0, 1);
                        } else {
                            const splicepoint = i + 1;
                            this.activities.splice(i, 1);
                        }
                        for (i = 0; i < this.activities.length; i++) {
                            activitiesName.push(this.activities[i].id);
                        }
                        this.activitiesList = activitiesName.join(",");
                    }
                }
            },
            /* addinfo
            * Add Activity info to list. The activity is then added to the activities list string. 
            * This is done to get results from JavaScript to play with php nicely.
            */
            addInfo: function(id, name) {
                this.message = name;
                if (!this.activities.some(data => data.message === name)) {
                    this.activities.push({
                        message: name,
                        id: id
                    });
                    let activitiesName = [];
                    for (i = 0; i < this.activities.length; i++) {
                        activitiesName.push(this.activities[i].id);
                    }
                    console.log(activitiesName);
                    this.activitiesList = activitiesName.join(",");
                } else {
                    alert('The activity "' + name + '" has already been selected.');
                }
            }
        }
    })
</script>