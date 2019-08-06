<template>
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 " >
                <div class="card card-default">
                    <div class="card-header">Developer Component</div>

                    <div class="card-body">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
