<?php

$this->data['jquery'] = array('version' => '1.6', 'core' => TRUE, 'ui' => TRUE, 'css' => TRUE);
$this->data['head']   = '
<style type="text/css">
.header-25 {
    font-weight: bold;
    text-decoration: underline;
    font-size: small;
}

.entity .messages p {
    margin:  0px;
    padding: 5px;
    text-align: center;
    font-weight: bold;
}

.entity .messages .error {
    background-color: #CD5C5C;
    color: white;
}

.entity .messages .warning {
    background-color: #F0E68C;
}
</style>
';
$this->includeAtTemplateBase('includes/header.php');
?>

<div id="tabdiv">
    <ul>
        <?php foreach ($this->data['entities'] as $type => $entities): ?>
        <li class="entity-type">
            <h1><?php
                if ($type=='saml20-sp') {
                    echo "Service Providers";
                } else if ($type==='saml20-idp') {
                    echo "Identity Providers";
                } else {
                    echo $type;
                }?></h1>
            <ul>
                <?php foreach ($entities as $entity): ?>
                <li class="entity">
                    <h2>
                        <?php echo $entity['Name']; ?>
                    </h2>

                    <div class="messages">
                    </div>

                    <script class="messages-template" type="text/x-jquery-tmpl">
                        {{each Errors}}
                        <p class="error">${$value}</p>
                        {{/each}}
                        {{each Warnings}}
                        <p class="warning">${$value}</p>
                        {{/each}}
                    </script>

                    <table class="entity-information">
                        <tr>
                            <th>Entity ID</th>
                            <td>
                                <a href="<?php echo $entity['Id'] ?>" class="entity-id">
                                    <?php echo $entity['Id'] ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Metadata URL</th>
                            <td>
                                <a href="<?php echo $entity['MetadataUrl'] ?>">
                                    <?php echo $entity['MetadataUrl'] ?>
                                </a>
                            </td>
                        </tr>
                    </table>

                    <br />

                    <p class="header-25">
                        Signing Certificate
                    </p>

                    <div class="entity-certificate-representation">
                    </div>

                    <div class="entity-certificate-information">
                        <img class="loading-image" alt='Loading...' src="resources/images/icons/spinner.gif" />
                    </div>

                    <script class="entity-certificate-information-template" type="text/x-jquery-tmpl">
                        <table>
                            <tr>
                                <th>Subject:</th>
                                <td>${Subject}</td>
                            </tr>
                            <tr>
                                <th>Starts / started:</th>
                                <td>${Starts_natural} (${Starts_relative})</td>
                            </tr>
                            <tr>
                                <th>Ends / ended:</th>
                                <td>${Ends_natural} (${Ends_relative})</td>
                            </tr>
                        </table>
                    </script>

                    <br />

                    <p class="header-25">
                        Endpoints
                    </p>
                    <img class="loading-image" alt='Loading...' src="resources/images/icons/spinner.gif" />
                    <ul class="entity-endpoints">
                    </ul>

                    <script class="entity-endpoint-template" type="text/x-jquery-tmpl">
                        <li>
                            <h3>
                                <img style="display: inline;" height="24px" width="24px" src="resources/images/icons/endpoint.png" alt="" />
                                ${Name}
                            </h3>
                            <a href="${Url}">${Url}</a>

                            <div class="messages">
                            </div>

                            <div class="entity-endpoint-certificate-representation">
                            </div>
                        </li>
                    </script>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<script type="text/javascript" src="resources/scripts/datehelper.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="resources/scripts/serviceregistry.validate.js"></script>
<?php
$this->includeAtTemplateBase('includes/footer.php');